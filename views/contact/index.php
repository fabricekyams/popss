<?php 
$vars = $this->getVars();
?>

<h1> </h1>
    <form  action="" method="post" enctype="multipart/form-data">
        <?= input('name', 'Votre nom')?>
        <?= input('firstname', 'votre prenom')?>
        <?= input('function', 'fonction')?>
        <?= input('company', 'company')?>
        <?= input('phone', 'TEl ou GSM')?>
        <?= input('email', 'mail')?>
	<?= textarea('message', 'Entrez votre message ici')?>

	    <div class="row">
		<div class=" col-md-8">
		    <button type="submit" name="_submit" class="btn btn-primary">Envoyer</button> 
	 	</div>
		
	     </div>
    </form>



		       
