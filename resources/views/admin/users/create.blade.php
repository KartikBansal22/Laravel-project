<h1>Create User</h1>

<form method="POST" action="/register">
    @csrf

  
    <input type="text" name="username" placeholder="Username"><br><br>
    <input type="email" name="email" placeholder="Email"><br><br>
    <input type="password" name="password" placeholder="Password"><br><br>

    <button type="submit">Create User</button>
</form>