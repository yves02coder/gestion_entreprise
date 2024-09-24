<aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-fixed">
  <!-- Brand Logo -->
  <a href="#" class="brand-link" style="background-color: #009E60!important;">
    <img src="../dist/img/control.jpg" alt="AdminLTE Logo" class="brand-image  elevation-3" style="width: 100px;height: 100px!important;">
    <span class="brand-text font-weight-light">SILOTEC-CI</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar" style="background-color: #009E60!important;">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar nav-child-indent  flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <!--  Menu BUDGET -->
        <?php 
        if(($_SESSION['role']!='commercial')&&($_SESSION['role']!='superviseur_v'))
        {
          ?>
        <li class="nav-header">BUDGET</li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-file-contract nav-icon"></i>
            <p>Ligne budgetataire
              <i class="right fas fa-angle-left"></i>
            </p>

          </a>

          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>
                  Ressource
                </p>
                <i class="right fas fa-angle-left"></i>
              </a>
              <ul class="nav nav-treeview">
              <?php 
              if(($_SESSION['role']!='daf')&&($_SESSION['role']!='dg')&&($_SESSION['role']!='controleur'))
              {
             ?>
              
                <li class="nav-item">
                  <a href="../ressource/creer_ligne_ressource.php" class="nav-link">

                    <p>
                      Nouvelle ressource
                    </p>
                  </a>
                </li>
                <?php 
                 }
                 ?>
                <li class="nav-item">
                  <a href="../ressource/liste_ressource_attente.php" class="nav-link">

                    <p>
                      Ressource en attente
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="../ressource/liste_ressource_valide.php" class="nav-link">

                    <p>
                      Ressource validée
                    </p>
                  </a>
                </li>

              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>
                  Emploi
                </p>
                <i class="right fas fa-angle-left"></i>
              </a>
              <ul class="nav nav-treeview">
              <?php 
              
              if(($_SESSION['role']!='daf')&&($_SESSION['role']!='dg')&&($_SESSION['role']!='controleur'))
              {
             ?>
                <li class="nav-item">
                  <a href="../emploi/creer_ligne_emploi.php" class="nav-link">

                    <p>
                      Nouvel emploi
                    </p>
                  </a>
                </li>
                <?php 
               }
             ?>
                <li class="nav-item">
                  <a href="../emploi/liste_emploi_attente.php" class="nav-link">

                    <p>
                      Emploi en attente
                    </p>
                  </a>
                </li>


                <li class="nav-item">
                  <a href="../emploi/liste_emploi_valide.php" class="nav-link">

                    <p>
                      Emploi validé
                    </p>
                  </a>
                </li>

              </ul>
            </li>
          </ul>

        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-plus-square"></i>
            <p>
              Besoins
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
          <?php 
              if(($_SESSION['role']!='daf')&&($_SESSION['role']!='dg')&&($_SESSION['role']!='controleur'))
              {
             ?>
            <li class="nav-item">
              <a href="../besoin/creer_besoin.php" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Nouveau besoin</p>
              </a>
            </li>
            <?php 
              }
             ?>
            <li class="nav-item">
              <a href="../besoin/besoin_attente.php" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Besoin en attente</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="../besoin/besoin_valide.php" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Besoin validé</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="../besoin/besoin_traite.php" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Besoin traité</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>
                  Proforma
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
              <?php 
              if(($_SESSION['role']!='daf')&&($_SESSION['role']!='dg')&&($_SESSION['role']!='controleur'))
              {
             ?>
                <li class="nav-item">
                  <a href="../fproforma/creer_fproforma.php" class="nav-link">
                    <p>Nouvelle proforma</p>
                  </a>
                </li>
                <?php 
              }
             ?>
                <li class="nav-item">
                  <a href="../fproforma/fproforma_attente.php" class="nav-link">

                    <p>Proforma en attente</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="../fproforma/fproforma_valide.php" class="nav-link">

                    <p>Proforma validée</p>
                  </a>
                </li>

              </ul>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-bars nav-icon"></i>
            <p>Bon de commande
              <i class="right fas fa-angle-left"></i>
            </p>

          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>
                  Engagement
                </p>
                <i class="right fas fa-angle-left"></i>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../bon_commande/engagement_attente.php" class="nav-link">

                    <p>
                      Engagement en attente
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="../bon_commande/engagement_valide.php" class="nav-link">
                    <p>
                      Engagement validé
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="../bon_commande/engagement_traite.php" class="nav-link">
                    <p>
                      Engagement traité
                    </p>
                  </a>
                </li>

              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>
                  Bon de commande
                </p>
                <i class="right fas fa-angle-left"></i>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../bon_commande/bon_commande_attente.php" class="nav-link">

                    <p>
                      Bon en attente
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="../bon_commande/bon_commande_valide.php" class="nav-link">

                    <p>
                      Bon validé
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="../bon_commande/bon_commande_traite.php" class="nav-link">

                    <p>
                      Bon traité
                    </p>
                  </a>
                </li>

              </ul>
            </li>
          </ul>
        </li>
        
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-credit-card nav-icon"></i>
            <p>Facture et OP
              <i class="right fas fa-angle-left"></i>
            </p>

          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>
                  Livraisons
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../livraison/liste_livraison.php" class="nav-link">

                    <p>
                      Livraison en attente
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="../livraison/livraison_traite.php" class="nav-link">

                    <p>
                      Livraison traiée
                    </p>
                  </a>
                </li>

              </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>
                  Factures
                  <i class="right fas fa-angle-left"></i>
                </p>

              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../bon_facture/facture_attente.php" class="nav-link">

                    <p>
                      Facture en attente
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="../bon_facture/facture_valide.php" class="nav-link">

                    <p>
                      Facture validée
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="../bon_facture/facture_traite.php" class="nav-link">

                    <p>
                      Facture traitée
                    </p>
                  </a>
                </li>

              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>
                  Ordre de paiement
                  <i class="right fas fa-angle-left"></i>
                </p>

              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../op/op_attente.php" class="nav-link">

                    <p>
                      OP en attente
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="../op/op_valide.php" class="nav-link">

                    <p>
                      OP validé
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="../op/op_traite.php" class="nav-link">

                    <p>
                      OP traité
                    </p>
                  </a>
                </li>


              </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>
                  Chèque
                  <i class="right fas fa-angle-left"></i>
                </p>

              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../cheque/cheque_attente.php" class="nav-link">

                    <p>
                      Chèque en attente
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="../cheque/cheque_valide.php" class="nav-link">

                    <p>
                      Chèque validé
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="../cheque/cheque_traite.php" class="nav-link">

                    <p>
                      Chèque traité
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="../cheque/cheque_retire.php" class="nav-link">

                    <p>
                      Chèque retiré
                    </p>
                  </a>
                </li>


              </ul>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-user-circle"></i>
            <p>
              Fournisseur
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
          <?php 
              if(($_SESSION['role']!="daf")&&($_SESSION['role']!="dg")&&($_SESSION['role']!="controleur"))
              {
             ?>
            <li class="nav-item">
              <a href="../fournisseur/creer_fournisseur.php" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Nouveau fournisseur</p>
              </a>
            </li>
            <?php 
              
              }
             ?>
            <li class="nav-item">
              <a href="../fournisseur/fournisseur_attente.php" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Fournisseur attente</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="../fournisseur/fournisseur_valide.php" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Fournisseur validé</p>
              </a>
            </li>
          </ul>
        </li>
        <?php
        }
       
        if(($_SESSION['role']!="comptable")&&($_SESSION['role']!="superviseur"))
        {
         
        ?>
        <li class="nav-header">VENTE</li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-file"></i>
            <p>
              Proforma
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
          <?php 
              if(($_SESSION['role']!="daf")&&($_SESSION['role']!="dg")&&($_SESSION['role']!="controleur"))
              {
             ?>
            <li class="nav-item">
              <a href="../proforma/creer_proforma.php" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Nouvelle proforma</p>
              </a>
            </li>
            <?php 
             }
             ?>
            <li class="nav-item">
              <a href="../proforma/proforma_attente.php" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Proforma en attente</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="../proforma/proforma_valide.php" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Proforma validée</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="../proforma/proforma_traite.php" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Proforma traitée</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-table"></i>
            <p>
              Commande
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
          <?php 
              if(($_SESSION['role']!="daf")&&($_SESSION['role']!="dg")&&($_SESSION['role']!="controleur"))
              {
             ?>
            <li class="nav-item">
              <a href="../commande/creer_commande.php" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Nouvelle commande</p>
              </a>
            </li>
            <?php 
              }
             ?>
            <li class="nav-item">
              <a href="../commande/commande_attente.php" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Commande en cours</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="../commande/commande_valide.php" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Commande validée</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="../commande/commande_traite.php" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Commande traitée</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-credit-card nav-icon"></i>
            <p>Facture et Règlement
              <i class="right fas fa-angle-left"></i>
            </p>

          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>
                  Factures
                  <i class="right fas fa-angle-left"></i>
                </p>

              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../facture/facture_attente.php" class="nav-link">

                    <p>
                      Facture en attente
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="../facture/facture_valide.php" class="nav-link">

                    <p>
                      Facture validée
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="../facture/facture_traite.php" class="nav-link">
                    <p>
                      Facture traitée
                    </p>
                  </a>
                </li>

              </ul>
            </li>
            <li class="nav-item">
              <a href="../facture/encaissement.php" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>
                  Encaissemment 
                  
                </p>

              </a>
            </li>

          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-user-circle"></i>
            <p>
              Client
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
          <?php 
              if(($_SESSION['role']!="daf")&&($_SESSION['role']!="dg")&&($_SESSION['role']!="controleur"))
              {
             ?>
            <li class="nav-item">
              <a href="../client/creer_client.php" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Nouveau client</p>
              </a>
            </li>
            <?php 
              }
             ?>
            <li class="nav-item">
              <a href="../client/prospects.php" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Prospects</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="../client/client_valide.php" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Clients</p>
              </a>
            </li>
          </ul>
        </li>
        <?php
        }
       
        if(($_SESSION['role']!="daf")&&($_SESSION['role']!="dg")&&($_SESSION['role']!="controleur"))
        {
         
        ?>
        <li class="nav-header">PARAMETRE</li>
        <?php 
              if(($_SESSION['role']!="commercial")&&($_SESSION['role']!="superviseur_v"))
              {
             ?>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-file-contract nav-icon"></i>
            <p>Budget/Ressources
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>
                  Ressources
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../ressource/creer_ressource.php" class="nav-link">
                    <p>Nouvelle ressource</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../ressource/liste_ressource.php" class="nav-link">
                    <p>Liste ressources</p>
                  </a>
                </li>
              </ul>

            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>
                  Sous-ressources
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../ressource/creer_sous_ressource.php" class="nav-link">

                    <p>Nouvelle S/Ressource</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../ressource/liste_sous_ressource.php" class="nav-link">

                    <p>Liste S/Ressource</p>
                  </a>
                </li>

              </ul>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-file-contract nav-icon"></i>
            <p>Budget/Emploi
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>
                  Nature
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../emploi/creer_nature.php" class="nav-link">

                    <p>Nouvelle nature</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../emploi/liste_nature.php" class="nav-link">

                    <p>Liste nature</p>
                  </a>
                </li>

              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>
                  Activité
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../emploi/creer_activite.php" class="nav-link">

                    <p>Nouvelle activité</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../emploi/liste_activite.php" class="nav-link">

                    <p>Liste activité</p>
                  </a>
                </li>

              </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>
                  Emploi
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../emploi/creer_emploi.php" class="nav-link">

                    <p>Nouvel emploi</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../emploi/liste_emploi.php" class="nav-link">

                    <p>Liste emploi</p>
                  </a>
                </li>

              </ul>
            </li>

          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-home nav-icon"></i>
            <p>Services
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="../service/creer_service.php" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>
                  Nouveau service
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../service/liste_service.php" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>
                  Liste service
                </p>
              </a>
            </li>

          </ul>
        </li>
        <?php 
              }
              if(($_SESSION['role']!="comptable")&&($_SESSION['role']!="superviseur"))
              {
             ?>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-shopping-basket nav-icon"></i>
            <p>Produit
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="../produit/creer_produit.php" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>
                  Nouveau produit
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../produit/produit_attente.php" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>
                  Produits en attente 
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../produit/produit_valide.php" class="nav-link">
                <i class="far fa-dot-circle  nav-icon"></i>
                <p>
                  Produits validés 
                </p>
              </a>
            </li>

          </ul>
        </li>
        <?php 
              }
              if($_SESSION['role']=="admin")
              {
             ?>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-users nav-icon"></i>
            <p>Utilisateurs
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="../users/creer_user.php" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>
                  Nouvel utilisateur
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../users/liste_user.php" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>
                  Liste utilisateurs
                </p>
              </a>
            </li>

          </ul>
        </li>
        <?php 
              }
            }
             ?>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>