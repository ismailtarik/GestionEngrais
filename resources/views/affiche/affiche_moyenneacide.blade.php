<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affiche moyennes acides</title>
    <link rel="stylesheet" href="css/moyennesaffiche.css">
    @include('boots')
</head>

<body>
    <header class="bg-light">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="images/logo_ferti.png" alt="Logo Ferti" height="50">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('accueil_analyste') }}">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('ajouter_lign') }}">AjoutTableau</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Menu
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('toutes-heurestsp') }}">Afficher produit TSP</a>
                                <a class="dropdown-item" href="{{ route('toutes-heuresproduit') }}">Afficher produits</a>
                                <a class="dropdown-item" href="{{ route('AfficherAcide') }}">Afficher acides</a>
                                <a class="dropdown-item" href="{{ route('toutes-moyennestsp') }}">Afficher moyenne TSP</a>
                                <a class="dropdown-item" href="{{ route('toutes-moyennes') }}">Afficher moyennes</a>
                                <a class="dropdown-item" href="{{ route('AfficherMoyacide') }}">Afficher moyennes acides</a>
                                <a class="dropdown-item" href="{{ route('chartTsp') }}">Afficher courbes TSP</a>
                                <a class="dropdown-item" href="{{ route('chart') }}">Afficher courbes</a>
                                <a class="dropdown-item" href="{{ route('chartacide') }}">Afficher courbe Acide</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                                <form method="GET" class="p-12">
                                    <div class="mb-5">
                                        <label for="search-date" class="form-label">Date de saisie :</label>
                                        <input type="date" id="search-date" name="search_date" class="form-control">
                                    </div>
                                    <div class="mb-5">
                                        <label for="nom_lign" class="form-label">Nom de la ligne :</label>
                                        <select name="nom_lign" id="nom_lign" class="form-select">
                                            <option value="#">choisir une ligne</option>
                                            <option value="07A">07A</option>
                                            <option value="07B">07B</option>
                                            <option value="07C">07C</option>
                                            <option value="07D">07D</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-5">Rechercher</button>
                                </form>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#foot">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('log_out') }}">Deconnexion</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>



    <!-- afficher moyennes -->

    <div class="container" id="marg">

       

        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif

        @if ($errors->has('champs_requis'))
            <div class="alert alert-danger">
                {{ $errors->first('champs_requis') }}
            </div>
            @endif

        @if(isset($resultatmoyennes))
        @if(isset($_GET['search_date']) && isset($_GET['nom_lign']))
        @foreach($resultatmoyennes as $resultatmoyenne)
        @if($resultatmoyenne['date_saisi'] == $_GET['search_date'] && $resultatmoyenne['nom_ligne'] == $_GET['nom_lign'])
        <table class="table table-striped">
            <thead>
                <tr class="border">
                    <td colspan="3" class="border" >Saiseur : <strong>{{ $resultatmoyenne['saiseur'] }}</strong></td>
                    <td colspan="3" class="border" >Nom d'unite : <strong> {{ $resultatmoyenne['nom_ligne'] }}</strong></td>
                </tr>

                <tr>
                    <td colspan="3" class="border" >Nom produit : <strong> {{ $resultatmoyenne['nom_produit'] }}</strong></td>
                    <td colspan="2" class="border" >qualite : <strong> {{ $resultatmoyenne['qlt'] }}</strong></td>
                    <td colspan="3" class="border" >date de saisi : <strong>{{ $resultatmoyenne['date_saisi'] }}</strong></td>
                </tr>


                <tr>

                    <th class="border">densite</th>
                    <th class="border">Tc</th>
                    <th class="border">P2O5</th>
                    <th class="border">TS</th>
                    <th class="border">SO4</th>
                    <th class="border">action1</th>
                    <th class="border">action2</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border">

                    <td class="border">{{ $resultatmoyenne['densite'] }}</td>
                    <td class="border">{{ $resultatmoyenne['Tc'] }}</td>
                    <td class="border">{{ $resultatmoyenne['p2o5'] }}</td>
                    <td class="border">{{ $resultatmoyenne['TS'] }}</td>
                    <td class="border">{{ $resultatmoyenne['SO4'] }}</td>
                    <td class="border">

                        <form action="{{ route('delete_resultatmoyenne', $resultatmoyenne['id_moy']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                    <td class="border">
                        <form action="{{ route('update_moyenneacide') }}" method="POST">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="id_moy" value="{{ $resultatmoyenne['id_moy'] }}">
                            <button type="submit" class="btn btn-success btn-sm">Update</button>
                        </form>
                    </td>

                </tr>
            </tbody>
        </table>
        @endif
        @endforeach
        @else
        @foreach($resultatmoyennes as $resultatmoyenne)
        <div class="top">
            <table class="table table-striped">
                <thead>
                    <tr class="border">
                        <td colspan="3" class="border" >Saiseur : <strong>{{ $resultatmoyenne['saiseur'] }}</strong></td>
                        <td colspan="3" class="border" >Nom d'unite : <strong> {{ $resultatmoyenne['nom_ligne'] }}</strong></td>
                    </tr>

                    <tr>
                        <td colspan="3" class="border" >Nom produit : <strong> {{ $resultatmoyenne['nom_produit'] }}</strong></td>
                        <td colspan="2" class="border" >qualite : <strong> {{ $resultatmoyenne['qlt'] }}</strong></td>
                        <td colspan="3" class="border" >date de saisi : <strong>{{ $resultatmoyenne['date_saisi'] }}</strong></td>
                    </tr>


                    <tr>

                        <th class="border">densite</th>
                        <th class="border">Tc</th>
                        <th class="border">P2O5</th>
                        <th class="border">TS</th>
                        <th class="border">SO4</th>
                        <th class="border">action1</th>
                        <th class="border">action2</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border">

                        <td class="border">{{ $resultatmoyenne['densite'] }}</td>
                        <td class="border">{{ $resultatmoyenne['Tc'] }}</td>
                        <td class="border">{{ $resultatmoyenne['p2o5'] }}</td>
                        <td class="border">{{ $resultatmoyenne['TS'] }}</td>
                        <td class="border">{{ $resultatmoyenne['SO4'] }}</td>
                        <td class="border">
                            <form action="{{ route('delete_resultatmoyenne', $resultatmoyenne['id_moy']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                        <td class="border">
                            <form action="{{ route('update_moyenneacide') }}" method="POST">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="id_moy" value="{{ $resultatmoyenne['id_moy'] }}">
                                <button type="submit" class="btn btn-success btn-sm">Update</button>
                            </form>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
        @endforeach
        @endif
        @endif
    </div>


    <script>
        // Initialiser le menu déroulant Bootstrap
        var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
        var dropdownList = dropdownElementList.map(function(dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl)
        });
    </script>

</body>
<div id="foot">
    @include('footer')
</div>

</html>