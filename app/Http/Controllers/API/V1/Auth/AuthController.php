<?php

namespace App\Http\Controllers\API\V1\Auth;

use EMedia\Api\Docs\APICall;
use EMedia\Api\Docs\Param;
use Illuminate\Http\Request;

class AuthController extends \EMedia\Oxygen\Http\Controllers\API\V1\Auth\AuthController
{

    /**
     *
     * Fillable parameters when registering a new user
     * Only add fields that must be auto-filled
     *
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'date_of_birth',
    ];

    /**
     *
     * Fillable parameters for devices.
     *
     */
    protected $fillableDeviceParams = [
        'device_id', 'device_type', 'device_push_token'
    ];

    /**
     *
     * Validation rules to be enforced when registering.
     *
     * @return array
     */
    protected function getRegistrationValidationRules(): array
    {
	    return [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|min:8',
            'date_of_birth' => 'required|date',
            'phone'       => 'required|unique:users,phone|numeric|digits_between:9,10',
            'device_id'   => 'required',
            'device_type' => 'required',
        ];
    }

    /**
     * @return array
     */
    protected function getRegistrationApiDocParams(): array
    {
        return [
            (new Param('device_id', 'String', 'Unique ID of the device')),
            (new Param('device_type', 'String', 'Type of the device `APPLE` or `ANDROID`')),
            (new Param('device_push_token', 'String', 'Unique push token for the device'))->optional(),

            (new Param('first_name', 'String', 'First name of user'))
                ->setDefaultValue('Joe'),
            (new Param('last_name', 'String', 'Last name of user'))
                ->setDefaultValue('Johnson'),
            (new Param('email', 'String', 'Email address of user')),
            (new Param(
                'phone',
                'String',
                'Phone number in international format'))->setDefaultValue('+xx123456789'),
            (new Param('date_of_birth', 'String', 'Date of birth in YYYY/MM/DD format'))
                ->setDefaultValue('1990/10/24'),
            (new Param('password', 'string',
                'Password. Must be at least 8 characters.'))->setDefaultValue('12345678'),
        ];
    }

    /**
     * @return \Closure
     */
    protected function getApiDocumentFunction(): callable
    {
        return function () {
            return (new APICall)->setName('Register')
                ->setDescription('This endpoint registers a user. If you need to update a profile image, upload the profile image in the background using `/avatar` endpoint.')
                ->setParams($this->getRegistrationApiDocParams())
                ->noDefaultHeaders()
                ->setHeaders([
                    (new Param('Accept', 'String', '`application/json`'))->setDefaultValue('application/json'),
                    (new Param('x-api-key', 'String', 'API Key'))->setDefaultValue('123-123-123-123'),
                ])
                ->setErrorExample('{
					"message": "The email must be a valid email address.",
					"payload": {
						"errors": {
							"email": [
								"The email must be a valid email address."
							]
						}
					},
					"result": false
				}', 422);
        };
    }

    /**
     *
     * Register a user.
     *
     * You probably don't need to duplicate this function.
     * See the other functions and parameters which can be extended as required.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request) {
        document($this->getApiDocumentFunction());

        $this->validate($request, $this->getRegistrationValidationRules());

        $data = $request->only($this->fillable);
        $data['password'] = bcrypt($data['password']);
        $user = $this->usersRepository->create($data);

        $responseData = $user->toArray();
        $deviceData = $request->only($this->fillableDeviceParams);
        $device = $this->devicesRepo->createOrUpdateByIDAndType($deviceData, $user->id);
        $responseData['access_token'] = $device->access_token;

        return response()->apiSuccess($responseData);
    }


    // Add your logic here

}
