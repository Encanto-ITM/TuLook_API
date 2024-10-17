<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TuLook_API</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="./css/app.css">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Link de bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-dark text-white container">
    <main class="mt-6 text-center mb-4">
        <h1 class="font-bold">Bienvenido a TuLook API</h1>
        <h2>Estos son los links a los que puedes acceder</h2>
    </main>
    <section class="">
        <div class="row gap-2 justify-content-center">
            <div class="col-5 p-2 bg-black rounded-4 bg-opacity-25">
                <h2 class="font-weight-bolder">Usuarios</h2><hr>
                <ul>
                    <li>
                        ( <span style="color: blue">R</span>
                        <span style="color: orange">U</span>
                        <span style="color: red">D</span> ):
                        <a href="/api/api/users">/api/users</a>
                        <span>→ Accede a todos los usuarios</span>
                    </li>
                    <li>
                        ( <span style="color: blue">GET</span> ):
                        <a href="/api/api/admins">/api/admins</a> 
                        <span>→ Accede a todos los administradores</span>
                    </li>
                    <li>
                        ( <span style="color: blue">GET</span> ):
                        <a href="/api/api/clients">/api/clients</a> 
                        <span>→ Accede a todos los clientes</span>
                    </li>
                    <li>
                        ( <span style="color: blue">GET</span> ):
                        <a href="/api/api/workers">/api/workers</a> 
                        <span>→ Accede a todos los trabajadores</span>
                    </li>
                    <li>
                        ( <span style="color: green">POST</span> ):
                        <a href="/api/api/users/update-password">/api/users/update-password</a> 
                        <span>→ Actualiza la contraseña</span>
                    </li>
                </ul>
            </div>
            <div class="col-5 p-2 bg-black rounded-4 bg-opacity-25">
                <h2 class="font-weight-bolder">Servicios</h2><hr>
                <ul>
                    <li>
                        ( <span style="color: green">C</span>
                        <span style="color: blue">R</span>
                        <span style="color: orange">U</span>
                        <span style="color: red">D</span> ):
                        <a href="/api/api/services">/api/services</a> 
                        <span>→ Accede a todos los servicios</span>
                    </li>
                    <li>
                        ( <span style="color: blue">GET</span> ):
                        <a href="/api/api/services/{ownerId}/owner">/api/services/{ownerId}/owner</a> 
                        <span>→ Accede a todos los servicios de un usuario</span>
                    </li>
                    <li>
                        ( <span style="color: blue">GET</span> ):
                        <a href="/api/api/services/search?name={related_name}">/api/services/search?name={"related_name"}</a>
                        <span>→ Devuelve los servicios que coincidan con el nombre</span>
                    </li>
                    <li>
                        ( <span style="color: blue">GET</span> ):
                        <a href="/api/api/services/{typeId}/filtertype">/api/services/{typeId}/filtertype</a>
                        <span>→ Devuelve los servicios filtrados por tipo</span>
                    </li>
                </ul>
            </div>
            <div class="col-5 p-2 bg-black rounded-4 bg-opacity-25">
                <h2 class="font-weight-bolder">Citas</h2><hr>
                <ul>
                    <li>
                        ( <span style="color: green">C</span>
                        <span style="color: blue">R</span>
                        <span style="color: orange">U</span>
                        <span style="color: red">D</span> ):
                        <a href="/api/api/appointments">/api/appointments</a> 
                        <span>→ Accede a todas las citas</span>
                    </li>
                    <li>
                        ( <span style="color: blue">GET</span> ):
                        <a href="/api/api/appointments/{ownerId}/owner">/api/appointments/{ownerId}/owner</a> 
                        <span>→ Accede a todas las citas de un emprendedor</span>
                    </li>
                    <li>
                        ( <span style="color: blue">GET</span> ):
                        <a href="/api/api/appointments/{clientId}/client">/api/appointments/{clientId}/client</a> 
                        <span>→ Accede a todas las citas de un cliente</span>
                    </li>
                </ul>
            </div>
            <div class="col-5 p-2 bg-black rounded-4 bg-opacity-25">
                <h2 class="font-weight-bolder">Otros</h2><hr>
                <ul>
                    <li>
                        ( <span style="color: green">C</span>
                        <span style="color: blue">R</span>
                        <span style="color: orange">U</span>
                        <span style="color: red">D</span> ):
                       <a href="/api/api/type_services">/api/type_services</a>
                        <span>→ Accede a todos los tipos de servicio</span>
                    </li>
                    <li>
                        ( <span style="color: green">C</span>
                        <span style="color: blue">R</span>
                        <span style="color: orange">U</span>
                        <span style="color: red">D</span> ):
                        <a href="/api/api/professions">/api/professions</a>
                        <span>→ Accede a todas las profesiones</span>
                    </li>
                    <li>
                        ( <span style="color: green">C</span>
                        <span style="color: blue">R</span>
                        <span style="color: orange">U</span>
                        <span style="color: red">D</span> ):
                        <a href="/api/api/acounttypes">/api/acounttypes</a>
                        <span>→ Accede a todos los tipos de cuenta</span>
                    </li>
                </ul>
            </div>
            <div class="col-5 p-2 bg-black rounded-4 bg-opacity-25">
                <h2 class="font-weight-bolder">JWT-login/logout</h2><hr>
                <ul>
                    <li>
                        ( <span style="color: green">Post</span> ):
                       <a href="/api/api/auth/register">/api/auth/register</a>
                        <span>→ Registra un usuario</span>
                    </li>
                    <li>
                        ( <span style="color: green">Post</span> ):
                        <a href="/api/api/auth/login">/api/auth/login</a>
                        <span>→ Inicia sesión</span>
                    </li>
                    <li>
                        ( <span style="color: green">Post</span> ):
                        <a href="/api/api/auth/me">/api/auth/me</a>
                        <span>→ Obtiene los datos del usuario loggeado con el JWT</span>
                    </li>
                    <li>
                        ( <span style="color: green">Post</span> ):
                        <a href="/api/api/auth/refresh">/api/auth/refresh</a>
                        <span>→ Renueva el JWT</span>
                    </li>
                    <li>
                        ( <span style="color: green">Post</span> ):
                        <a href="/api/api/auth/logout">/api/auth/logout</a>
                        <span>→ Cierra la sesión</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</body>

</html>
