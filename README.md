# common-passwords
A simple package to validate against common passwords and help keep your application secure.

* Install.  It's not in any repositories yet.
* php artisan common-passwords:install
* Add the \Crumbls\CommonPasswords\Rules\NotCommonPassword() rule to your password field.
   * Best practice says that the best place to do this is to put it into your registration and password recovery validators.  
* You can add any extra passwords using the \Crumbls\CommonPasswords\Models\Password model.  It only has one field: password

Attached is a simple example that can be ran from anywhere.  It will throw a validation exception because we are
verifying the password "password" which is a commonly used password.

```php
try {
    $validator = \Illuminate\Support\Facades\Validator::make([
        'password' => 'password'
    ], [
        'password' => [
            'required',
            'string',
            'min:1',
            'max:256',
            new \Crumbls\CommonPasswords\Rules\NotCommonPassword()
        ],
    ]);
    print_r($validator->validated());
} catch (\Illuminate\Validation\ValidationException $e) {
    echo $e->getMessage();
}
```

Since authentication and registration are commonly reinvented based on the application, this is an example
of how you could do it in a very basic RegistrationController out of Laravel 8.x.  This would overwrite your 
validator method.

```php
 /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', new \Crumbls\CommonPasswords\Rules\NotCommonPassword()],
        ]);
    }
```

I've had a people ask if you can use this to directly check if a user's password is on this list.  It's a horrible idea
because of the resources it consumes and this is just brute force testing.  That is why you should verify it when you 
are setting the password.  But, if you need to for some reason, here is a simple sample on how to do it.

```php
// Take a random user.  You should be more pointed than this.
$user = \App\Models\User::inRandomOrder()->take(1)->first();
    $passwords = \Crumbls\CommonPasswords\Models\Password::orderBy(
        with(new \Crumbls\CommonPasswords\Models\Password())->getKeyName(),
        'asc'
    )->get();
    foreach($passwords as $password) {
        if (\Hash::check($password->password, $user->password)) {
            printf('User had an invalid password: %s .', $password->password);
            break;
        }
    }
```

The documentation is sparse.  If you have any questions, feel free to ask here or on twitter @chasecmiller
Remember that this is only designed to be a validation rule.
