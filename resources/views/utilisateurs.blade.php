<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Utilisateurs</title>
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

       
        @media (max-width: 768px) {
            table {
                width: 100%;  
                font-size: 14px; 
            }

            th, td {
                padding: 8px; 
            }

            .container {
                width: 100%; 
                padding: 10px;
            }
        }

        @media (max-width: 480px) {
            h2 {
                font-size: 18px; 
            }

            button.delete {
                padding: 4px 8px; 
            }

            button.edit {
                padding: 4px 8px; 
            }
        }
    </style>
</head>
<body>
    <div class="container">
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
                                <a href="{{ route('edit', $created->id) }}">
                                    <button class="edit">Modifier</button>
                                </a>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
