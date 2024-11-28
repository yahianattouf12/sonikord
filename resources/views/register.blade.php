/*
 !----------------------------------------------------
 !
 ! this file is just to test google service ...
 !
 !----------------------------------------------------
*/

<form action = "{{ route('user.register') }}" method = "POST">
    @csrf
    <input type = "text" name = "first_name" placeholder = "First Name"><br>
    <input type = "text" name = "last_name" placeholder = "Last Name"><br>
    <input type = "email" name = "email" placeholder = "Email"><br>
    <input type = "text" name = "phone" placeholder = "Phone"><br>
    <input type = "password" name = "password" placeholder = "Password"><br>
    <input type = "password" name = "password_confirmation" placeholder = "Confirm Password"><br>
    <input type = "text" name = "address" placeholder = "Address"><br>
    <input type = "text" name = "role" placeholder = "role"><br>
    <input type = "submit" submit name = "submit" value = "submit">click me</input>   
</form>