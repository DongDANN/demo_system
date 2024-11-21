console.log("validation.js loaded successfully");

const validation = new JustValidate('#signup-form');

validation
  .addField('#name', [
    {
      rule: 'required',
    }
])
  .addField('#email', [
    {
      rule: 'required',
    },
    {
      rule: 'email',
    },
    {
      validator: (value) => () => {
        return fetch("components/proc_validate_email.php?email=" + encodeURIComponent(value))
              .then(function(response) {
                return response.json();
              })
              .then(function(json){
                return json.available;
              });
      },
      errorMessage: 'Email is already taken'
    }
  ])
  .addField('#phone', [
    {
      rule: 'required',
    },
    {
      rule: 'number',
    },
    {
      validator: (value) => () => {
        return fetch("components/proc_validate_phone.php?phone=" + encodeURIComponent(value))
              .then(function(response) {
                return response.json();
              })
              .then(function(json){
                return json.available;
              });
      },
      errorMessage: 'Phone is already taken'
    }
  ])
  .addField('#password', [
    {
      rule: 'required',
    },
    {
      rule: 'password',
    },
  ])
  .addField('#confirm-password', [
    {
      rule: 'required',
    },
    {
      validator: (value, fields) => {
        if (fields['#password'] && fields['#password'].elem) {
          const repeatPasswordValue = fields['#password'].elem.value;
          return value === repeatPasswordValue;
        }
        return false;
      },
      errorMessage: 'Password should match',
    }
  ])

  .onSuccess((event) => {
    document.getElementById('signup-form').submit();
  });
