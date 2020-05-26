<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>36Errors Crossins</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.2/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
  </head>
  <body>
  <section class="section main">
    <div class="container">
      <div class="columns">
        <div class="column is-three-quarters">
          <article class="columns is-multiline">
            <div>
            <?php if (count($villages) > 0): ?>
              <?php foreach ($villages as $village): ?>
                <?php include("views/partials/village_card.html.php");?>
              <?php endforeach ?>
            
            <?php else: ?>  
              <em>Vous n'avez pas encore de villages</em>
            <?php endif ?>


          </article>
        </div>
        <div class="column is-one-quarter">
          <?php include("partials/next_turn.html.php");?>

          <?php include("partials/village_form.html.php");?>

          <?php include("partials/villager_form.html.php");?>


        </div>
      </div>
    </div>
    </div>
  </section>
  </body>
</html>