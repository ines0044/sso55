<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Utilisateur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .error-message {
            color: red;
            font-size: 0.875rem;
            margin-top: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .success {
            color: green;
            margin-bottom: 15px;
        }

        .errors {
            color: red;
            margin-bottom: 15px;
        }

        ul {
            padding-left: 20px;
        }

        ul li {
            margin-bottom: 5px;
        }
        a {
           color: inherit; 
           text-decoration: none; 
          }

        a:hover {
           text-decoration: none; 
         }
    </style>
</head>
<body>
    <div>
        <h2>Créer un nouvel utilisateur</h2>

        
        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        
        <form action="{{ route('created.store') }}" method="POST">
            @csrf

            <div>
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" name="username" id="username" value="{{ old('username') }}" required>
                @error('username')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="first_name">Prénom :</label>
                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required>
                @error('first_name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="last_name">Nom :</label>
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required>
                @error('last_name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="phone">Téléphone :</label>
                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required>
                @error('phone')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="email">Email :</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" id="password" required>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password_confirmation">Confirmer le mot de passe :</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
                @error('password_confirmation')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div>
    <label for="platform_id">Plateforme :</label>
    <select name="platform_id" id="platform_id">
        <option value="">Aucune</option>
        @foreach($platforms as $platform)
            <option value="{{ $platform->id }}">{{ $platform->name }}</option>
        @endforeach
    </select>
        </div>


            <button type="submit">Créer l'utilisateur</button> <p>
            <button> <a href="{{ route('created.index') }}">Voir la liste des utilisateurs</a> </button> </p>
            
            <button> <a href="{{ route('platforms.index') }}">Créer des plateformes </a> </button>

        </form>
    </div>
</body>
</html>
