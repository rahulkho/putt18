# ************************************************* #
#       AUTO-GENERATED. DO NOT EDIT THIS FILE.      #
# ************************************************* #
#    Create your files in `resources/docs/manual`   #
# ************************************************* #
###
@apiDescription Get currently logged in user's profile
@apiVersion 1.0.0
@api {GET} api/v1/profile My Profile
@apiGroup Profile
@apiUse default_headers
@apiSuccessExample {json} Success-Response / HTTP 200 OK
{
				"payload": {
					"id": 3,
					"uuid": "1ed343b7-73c7-4b03-af53-c13bd47246b0",
					"first_name": "Ms. Alf",
					"last_name": null,
					"email": "swift.theresa@gmail.com.au",
					"avatar_url": null,
					"first_name": "Ms. Alf",
					"full_name": "Ms. Alf"
				},
				"message": "",
				"result": true
			}
###
# ************************************************* #
#       AUTO-GENERATED. DO NOT EDIT THIS FILE.      #
# ************************************************* #
#    Create your files in `resources/docs/manual`   #
# ************************************************* #
###
@apiVersion 1.0.0
@api {PUT} api/v1/profile Update My Profile
@apiGroup Profile
@apiParam {String} first_name First name
@apiParam {String} [last_name] Last name
@apiParam {String} email Email
@apiParam {String} [phone] Phone
@apiUse default_headers
@apiSuccessExample {json} Success-Response / HTTP 200 OK
{
				"payload": {
					"id": 3,
					"uuid": "11756f8a-9e4f-4c17-b1e6-2b860dd05f02",
					"first_name": "{{name}}",
					"last_name": "Johnson",
					"email": "fosinski@roodb.com.au",
					"phone": "06512345678",
					"avatar_url": "https://www.example.com/users/3/avatar.png",
					"first_name": "{{name}}",
					"full_name": "{{name}} Johnson"
				},
				"message": "",
				"result": true
			}
###
# ************************************************* #
#       AUTO-GENERATED. DO NOT EDIT THIS FILE.      #
# ************************************************* #
#    Create your files in `resources/docs/manual`   #
# ************************************************* #
###
@apiVersion 1.0.0
@api {POST} api/v1/avatar Update My Avatar
@apiGroup Profile
@apiParam {File} image Image
@apiUse default_headers
@apiSuccessExample {json} Success-Response / HTTP 200 OK
{
				"payload": {
					"id": 3,
					"uuid": "11756f8a-9e4f-4c17-b1e6-2b860dd05f02",
					"first_name": "{{name}}",
					"last_name": "Johnson",
					"email": "fosinski@roodb.com.au",
					"phone": "06512345678",
					"avatar_url": "https://www.example.com/users/3/avatar.png",
					"first_name": "{{name}}",
					"full_name": "{{name}} Johnson"
				},
				"message": "",
				"result": true
			}
###
