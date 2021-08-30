# common-passwords
A simple package to validate against common passwords and help keep your application secure.

* Install.  It's not in any repositories yet.
* php artisan common-passwords:install
* Add the \Crumbls\CommonPasswords\Rules\NotCommonPassword() rule to your password field.
   * Best practice says that the best place to do this is to put it into your registration and password recovery validators.  

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
