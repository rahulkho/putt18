# ************************************************* #
#       AUTO-GENERATED. DO NOT EDIT THIS FILE.      #
# ************************************************* #
#    Create your files in `resources/docs/manual`   #
# ************************************************* #
###
@apiVersion 1.0.0
@api {POST} api/v1/password/email Reset Password
@apiGroup ForgotPassword
@apiParam {String} email Email
@apiHeader {String} Accept `application/json`
@apiHeader {String} x-api-key API Key
@apiSuccessExample {json} Success-Response / HTTP 200 OK
{
					"payload": "",
					"message": "A password reset email will be sent to you in a moment.",
					"result": true
				}
@apiErrorExample {json} Error-Response / HTTP 422 Unprocessable Entity
{
					"message": "Failed to send password reset email. Ensure your email is correct and try again.",
					"payload": null,
					"result": false
				}
###
