define({ "api": [
  {
    "description": "<p>Logout the user from current device</p>",
    "version": "1.0.0",
    "type": "GET",
    "url": "api/v1/logout",
    "title": "Logout",
    "group": "Auth",
    "filename": "resources/docs/auto_generated/auth.coffee",
    "groupTitle": "Auth",
    "name": "GetApiV1Logout",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "version": "1.0.0",
    "type": "POST",
    "url": "api/v1/login",
    "title": "Login",
    "group": "Auth",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "device_id",
            "description": "<p>Unique ID of the device</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "device_type",
            "description": "<p>Type of the device <code>APPLE</code> or <code>ANDROID</code></p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "device_push_token",
            "description": "<p>Unique push token for the device</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Email</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Password</p>"
          }
        ]
      }
    },
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p><code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n\"payload\": {\n\"id\": 31,\n\"uuid\": \"6dfb4b23-df73-49d1-90ab-a3118cc170ed\",\n\"name\": \"null\",\n\"last_name\": \"null\",\n\"email\": \"test@example.com\",\n\"avatar_url\": null,\n\"first_name\": \"null\",\n\"full_name\": \"null null\",\n\"access_token\": \"1540054802BbiqclNMqujaIgfGzRMjsdds8a9M4HvBxPg\"\n},\n\"message\": \"\",\n\"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "resources/docs/auto_generated/auth.coffee",
    "groupTitle": "Auth",
    "name": "PostApiV1Login"
  },
  {
    "version": "1.0.0",
    "type": "POST",
    "url": "api/v1/password/edit",
    "title": "Update Password",
    "group": "Auth",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Password</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "current_password",
            "description": "<p>Current password</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password_confirmation",
            "description": "<p>Password confirmation</p>"
          }
        ]
      }
    },
    "filename": "resources/docs/auto_generated/auth.coffee",
    "groupTitle": "Auth",
    "name": "PostApiV1PasswordEdit",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "description": "<p>This endpoint registers a user. If you need to update a profile image, upload the profile image in the background using <code>/avatar</code> endpoint.</p>",
    "version": "1.0.0",
    "type": "POST",
    "url": "api/v1/register",
    "title": "Register",
    "group": "Auth",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "device_id",
            "description": "<p>Unique ID of the device</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "device_type",
            "description": "<p>Type of the device <code>APPLE</code> or <code>ANDROID</code></p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "device_push_token",
            "description": "<p>Unique push token for the device</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "first_name",
            "description": "<p>First name of user</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "last_name",
            "description": "<p>Last name of user</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Email address of user</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>Phone number in international format</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "date_of_birth",
            "description": "<p>Date of birth in YYYY/MM/DD format</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Password. Must be at least 8 characters.</p>"
          }
        ]
      }
    },
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p><code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          }
        ]
      }
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response / HTTP 422 Unprocessable Entity",
          "content": "{\n\"message\": \"The email must be a valid email address.\",\n\"payload\": {\n\"errors\": {\n\"email\": [\n\"The email must be a valid email address.\"\n]\n}\n},\n\"result\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "resources/docs/auto_generated/auth.coffee",
    "groupTitle": "Auth",
    "name": "PostApiV1Register"
  },
  {
    "description": "<p>FAQs and answers</p>",
    "version": "1.0.0",
    "type": "GET",
    "url": "api/v1/faqs",
    "title": "FAQs",
    "group": "FAQs",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "q",
            "description": "<p>Page number</p>"
          }
        ]
      }
    },
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p><code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n\"payload\": {\n\"Add your response here\"\n},\n\"message\": \"\",\n\"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "resources/docs/auto_generated/f_a_qs.coffee",
    "groupTitle": "FAQs",
    "name": "GetApiV1Faqs"
  },
  {
    "version": "1.0.0",
    "type": "POST",
    "url": "api/v1/password/email",
    "title": "Reset Password",
    "group": "ForgotPassword",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Email</p>"
          }
        ]
      }
    },
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p><code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n\"payload\": \"\",\n\"message\": \"A password reset email will be sent to you in a moment.\",\n\"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response / HTTP 422 Unprocessable Entity",
          "content": "{\n\"message\": \"Failed to send password reset email. Ensure your email is correct and try again.\",\n\"payload\": null,\n\"result\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "resources/docs/auto_generated/forgot_password.coffee",
    "groupTitle": "ForgotPassword",
    "name": "PostApiV1PasswordEmail"
  },
  {
    "version": "1.0.0",
    "type": "GET",
    "url": "api/v1/games",
    "title": "List Games",
    "group": "Games",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": true,
            "field": "p",
            "description": "<p>Page number. Default will be 1</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "status",
            "description": "<p>Accepted values <code>active</code>. Default is <code>all</code></p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "game_type",
            "description": "<p>Accepted values <code>hole-18</code>, <code>hole-9</code></p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "play_type",
            "description": "<p>Accepted values <code>single</code>, <code>team</code></p>"
          }
        ]
      }
    },
    "filename": "resources/docs/auto_generated/games.coffee",
    "groupTitle": "Games",
    "name": "GetApiV1Games",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "version": "1.0.0",
    "type": "POST",
    "url": "api/v1/games",
    "title": "Create Game",
    "group": "Games",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "date",
            "description": "<p>Date in DD/Mon/YYYY format</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "time",
            "description": "<p>Time in HH:MM AA format</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "formatted_address",
            "description": "<p>Displayed name of the venue</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "street",
            "description": "<p>Address line 1</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "street_2",
            "description": "<p>Address line 2</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "city",
            "description": "<p>Time in HH:MM AA format</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "state",
            "description": "<p>Time in HH:MM AA format</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "country",
            "description": "<p>Name of country</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "country_iso_code",
            "description": "<p>ISO code of venue country</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "game_type",
            "description": "<p>Accepted values <code>hole-18</code>, <code>hole-9</code></p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "play_type",
            "description": "<p>Accepted values <code>single</code>, <code>team</code></p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "game_max_player_limit",
            "description": "<p>Total players for game</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": true,
            "field": "team_max_player_limit",
            "description": "<p>Required for <code>team</code> games</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "player_order",
            "description": "<p>Accepted values <code>auto</code>, <code>manual</code></p>"
          },
          {
            "group": "Parameter",
            "type": "Boolean",
            "optional": false,
            "field": "has_wildcards",
            "description": "<p>Accepted values <code>true</code>, <code>false</code></p>"
          },
          {
            "group": "Parameter",
            "type": "Boolean",
            "optional": false,
            "field": "has_animations",
            "description": "<p>Accepted values <code>true</code>, <code>false</code></p>"
          }
        ]
      }
    },
    "filename": "resources/docs/auto_generated/games.coffee",
    "groupTitle": "Games",
    "name": "PostApiV1Games",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "description": "<p>Guest settings and parameters</p>",
    "version": "1.0.0",
    "type": "GET",
    "url": "api/v1/guests",
    "title": "Search Guest",
    "group": "Guest",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p><code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n\"payload\": {\n\"Add your response here\"\n},\n\"message\": \"\",\n\"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "resources/docs/auto_generated/guest.coffee",
    "groupTitle": "Guest",
    "name": "GetApiV1Guests"
  },
  {
    "version": "1.0.0",
    "type": "GET",
    "url": "api/v1/leaderboard",
    "title": "Get Rankings",
    "group": "Leaderboard",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": true,
            "field": "p",
            "description": "<p>Page number. Default will be 1</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "country_code",
            "description": "<p>ISO Country code</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "state",
            "description": "<p>State</p>"
          }
        ]
      }
    },
    "filename": "resources/docs/auto_generated/leaderboard.coffee",
    "groupTitle": "Leaderboard",
    "name": "GetApiV1Leaderboard",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "description": "<p>Claim an order ID and become a premium user</p>",
    "version": "1.0.0",
    "type": "POST",
    "url": "api/v1/claim-order",
    "title": "Claim an Order",
    "group": "Orders",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "order_id",
            "description": "<p>Order ID to claim</p>"
          }
        ]
      }
    },
    "filename": "resources/docs/auto_generated/orders.coffee",
    "groupTitle": "Orders",
    "name": "PostApiV1ClaimOrder",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "description": "<p>Get currently logged in user's profile</p>",
    "version": "1.0.0",
    "type": "GET",
    "url": "api/v1/profile",
    "title": "My Profile",
    "group": "Profile",
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n\"payload\": {\n\"id\": 3,\n\"uuid\": \"1ed343b7-73c7-4b03-af53-c13bd47246b0\",\n\"first_name\": \"Ms. Alf\",\n\"last_name\": null,\n\"email\": \"swift.theresa@gmail.com.au\",\n\"avatar_url\": null,\n\"first_name\": \"Ms. Alf\",\n\"full_name\": \"Ms. Alf\"\n},\n\"message\": \"\",\n\"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "resources/docs/auto_generated/profile.coffee",
    "groupTitle": "Profile",
    "name": "GetApiV1Profile",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "version": "1.0.0",
    "type": "POST",
    "url": "api/v1/avatar",
    "title": "Update My Avatar",
    "group": "Profile",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "File",
            "optional": false,
            "field": "image",
            "description": "<p>Image</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n\"payload\": {\n\"id\": 3,\n\"uuid\": \"11756f8a-9e4f-4c17-b1e6-2b860dd05f02\",\n\"first_name\": \"{{name}}\",\n\"last_name\": \"Johnson\",\n\"email\": \"fosinski@roodb.com.au\",\n\"phone\": \"06512345678\",\n\"avatar_url\": \"https://www.example.com/users/3/avatar.png\",\n\"first_name\": \"{{name}}\",\n\"full_name\": \"{{name}} Johnson\"\n},\n\"message\": \"\",\n\"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "resources/docs/auto_generated/profile.coffee",
    "groupTitle": "Profile",
    "name": "PostApiV1Avatar",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "version": "1.0.0",
    "type": "PUT",
    "url": "api/v1/profile",
    "title": "Update My Profile",
    "group": "Profile",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "first_name",
            "description": "<p>First name</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "last_name",
            "description": "<p>Last name</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Email</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "phone",
            "description": "<p>Phone</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n\"payload\": {\n\"id\": 3,\n\"uuid\": \"11756f8a-9e4f-4c17-b1e6-2b860dd05f02\",\n\"first_name\": \"{{name}}\",\n\"last_name\": \"Johnson\",\n\"email\": \"fosinski@roodb.com.au\",\n\"phone\": \"06512345678\",\n\"avatar_url\": \"https://www.example.com/users/3/avatar.png\",\n\"first_name\": \"{{name}}\",\n\"full_name\": \"{{name}} Johnson\"\n},\n\"message\": \"\",\n\"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "resources/docs/auto_generated/profile.coffee",
    "groupTitle": "Profile",
    "name": "PutApiV1Profile",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  }
] });
