<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Plateformes</title>
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

        form div {
            margin-bottom: 15px;
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
        }

        .add {
            background-color: green;
            color: white;
        }

        .edit {
            background-color: orange;
            color: white;
        }

        .delete {
            background-color: red;
            color: white;
        }

        button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <h2>Gestion des Plateformes</h2>

    
    <form action="{{ route('platforms.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Nom de la plateforme :</label>
            <input type="text" id="name" name="name" required />
        </div>

        
            <label for="usernames">Entrez les usernames (séparés par des virgules) :</label>
            <input type="text" id="usernames" name="usernames" />
        </div>

        <div>
            <label for="redirect_url">URL de redirection :</label>
            <input type="text" id="redirect_url" name="redirect_url" required />
        </div>

        <button type="submit">Ajouter la plateforme</button>
    </form>

    <!-- Liste des plateformes -->
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Username</th>
                <th>URL de Redirection</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($platforms as $platform)
                <tr>
                    <td>{{ $platform->name }}</td>
                    <td>
                    @if ($platform->createds->isNotEmpty())
                    @foreach ($platform->createds as $created)
                        {{ $created->username }}<br>
                    @endforeach
                @else
                    Aucun utilisateur associé
                @endif
                    </td>
                    <td>{{ $platform->redirect_url }}</td>
                     <td>
                     <form action="{{ route('platforms.edit', $platform->id) }}" method="GET" style="display:inline;">
                     @csrf
                    <button type="submit" class="edit" onclick="return confirm('Êtes-vous sûr de vouloir modifier cette plateforme ?')">Modifier</button>
                   </form>
                        

                        <!-- Formulaire pour supprimer la plateforme -->
                        <form action="{{ route('platforms.destroy', $platform->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette plateforme ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</body>
</html>
