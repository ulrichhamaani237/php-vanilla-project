<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commandes</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Styles pour la fenêtre modale */
        #commande-modal, #renvoi-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            width: 80%;
            max-width: 600px;
        }



        #modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        

        /* Style pour le bouton de fermeture */
        .close-modal {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: transparent;
            border: none;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Liste des commandes</h1>
        <ul id="commande-list">
            @foreach ($commandes as $commande)
                <li>
                    <button class="btn btn-info show-commande" data-id="{{ $commande->id }}">
                        Commande #{{ $commande->id }} - {{ $commande->nom_receveur }}
                    </button>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Overlay pour le fond -->
    <div id="modal-overlay"></div>

    <!-- Modal pour les détails de la commande -->
    <div id="commande-modal">
        <button class="close-modal">&times;</button>
        <h2>Détails de la commande</h2>
        <p id="commande-details"></p>
        <button id="delete-commande" class="btn btn-danger">Supprimer</button>
        <button id="renvoi-commande" class="btn btn-warning">Renvoyer</button>
    </div>

    <!-- Modal pour la date de renvoi -->
    <div id="renvoi-modal">
        <button class="close-modal">&times;</button>
        <h2>Définir la date de renvoi</h2>
        <input type="date" id="renvoi-date">
        <button id="update-date" class="btn btn-success">OK</button>
    </div>

    <script>
        $(document).ready(function () {
            // Configuration du token CSRF pour AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Affichage des détails de la commande dans la fenêtre modale
            $('.show-commande').click(function () {
                const id = $(this).data('id');
                $.get(`/commandes/${id}`, function (data) {
                    $('#commande-details').html(`
                        <p>Nom du receveur: ${data.nom_receveur}</p>
                        <p>Date: ${data.date}</p>
                        <p>Status: ${data.status}</p>
                        <p>Produits: ${data.produits}</p>
                        <p>Date de renvoi: ${data.date_renvoi || 'Non défini'}</p>
                    `);
                    $('#commande-modal').show();
                    $('#modal-overlay').show();
                });
            });

            // Fermer la fenêtre modale
            $('.close-modal').click(function () {
                $('#commande-modal').hide();
                $('#renvoi-modal').hide();
                $('#modal-overlay').hide();
            });

            // Supprimer la commande
            $('#delete-commande').click(function () {
                const id = $('.show-commande[data-id]').data('id');
                $.ajax({
                    url: `/commandes/${id}`,
                    type: 'DELETE',
                    success: function (result) {
                        alert(result.success);
                        location.reload();
                    },
                    error: function (xhr) {
                        alert(xhr.responseJSON.error);
                    }
                });
            });

            // Afficher la fenêtre modale pour la date de renvoi
            $('#renvoi-commande').click(function () {
                $('#renvoi-modal').show();
            });

            // Mettre à jour la date de renvoi
            $('#update-date').click(function () {
                const id = $('.show-commande[data-id]').data('id');
                const date_renvoi = $('#renvoi-date').val();
                $.ajax({
                    url: `/commandes/${id}`,
                    type: 'PUT',
                    data: { date_renvoi },
                    success: function (result) {
                        location.reload();
                    }
                });
            });
        });
    </script>
</body>
</html>
