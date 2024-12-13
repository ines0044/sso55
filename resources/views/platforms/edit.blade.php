<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Plateforme</title>
    <style>
        /* Style de base */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        form {
            width: 50%;
            background-color: white;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"], input[type="url"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: green;
            color: white;
        }

        button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <h2>Modifier la Plateforme</h2>

    <form action="{{ route('platforms.update', $platform->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Nom de la plateforme :</label>
            <input type="text" id="name" name="name" value="{{ $platform->name }}" required />
        </div>

        <div>
            <label for="usernames">Usernames (séparés par des virgules) :</label>
            <input type="text" id="usernames" name="usernames" value="{{ $usernames }}" required />
        </div>

        <div>
            <label for="redirect_url">URL de redirection :</label>
            <input type="url" id="redirect_url" name="redirect_url" value="{{ $platform->redirect_url }}" required />
        </div>

        <button type="submit">Mettre à jour</button>
    </form>
    @if ($errors->has('usernames'))
    <div style="color: red; font-size: 14px;">
        <ul>
            @foreach ($errors->get('usernames') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</body>
</html>
