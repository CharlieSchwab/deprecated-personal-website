<!doctype html>
<html>
    <head>
    </head>
    
    <body>
        <h1>Create Tag</h1>
        <form method='POST' action='/createTag'>
            @csrf
            <input type='text' name='name'/>
            <input type='text' name='icon_filepath'/>

            <input type='submit'/>Submit
        </form>
    </body>
</html>