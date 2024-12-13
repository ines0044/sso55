<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        table {
            width: 80%;
            margin: 20px 0;
            border-collapse: collapse;
            background-color: white;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        td {
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            padding: 10px;
        }

        button.delete {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        button.delete:hover {
            background-color: darkred;
        }

        button.edit {
            background-color: orange;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        button.edit:hover {
            background-color: darkorange;
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="tel"],
        input[type="email"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: green;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Liste des utilisateurs -->
        @if(!isset($created))
            <h2>Liste des Utilisateurs</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nom d'utilisateur</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($createds as $created)
                        <tr>
                            <td>{{ $created->username }}</td>
                            <td>{{ $created->first_name }}</td>
                            <td>{{ $created->last_name }}</td>
                            <td>{{ $created->phone }}</td>
                            <td>{{ $created->email }}</td>
                            <td>
                                <form action="{{ route('created.destroy', $created->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</button>
                                </form>
                                <a href="{{ route('created.edit', $created->id) }}">
                                    <button class="edit">Modifier</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <!-- Formulaire de modification -->
            <h2>Modifier l'utilisateur</h2>
            <form action="{{ route('created.update', $created->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div>
                    <label for="username">Nom d'utilisateur :</label>
                    <input type="text" name="username" id="username" value="{{ old('username', $created->username) }}" required>
                </div>

                <div>
                    <label for="first_name">Prénom :</label>
                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $created->first_name) }}" required>
                </div>

                <div>
                    <label for="last_name">Nom :</label>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $created->last_name) }}" required>
                </div>

                <div>
                    <label for="phone">Téléphone :</label>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone', $created->phone) }}" required>
                </div>

                <div>
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $created->email) }}" required>
                </div>

                <button type="submit">Mettre à jour</button>
            </form>
        @endif
    </div>
</body>
</html>
