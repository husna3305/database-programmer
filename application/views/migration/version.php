<!DOCTYPE html>

<html lang="en">

<head>

  <base href="<?= base_url() ?>" />

  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Migrations</title>

  <style>
    ul {

      list-style-type: none;

    }



    li {

      padding: 3px 0px;

    }



    button.current-version {

      background-color: #7ef461;

    }
  </style>

</head>

<body>

  <div id="app">

    <ul>

      <?php foreach ($migrations as $migration) : ?>

        <li>

          <a href="migration/set_version/<?= $migration['version'] ?>">

            <button id='<?= $migration['version'] == $current_version ? 'current-version' : '' ?>' class='<?= $migration['version'] == $current_version ? 'current-version' : '' ?>' <?= $migration['version'] == $current_version ? 'disabled' : '' ?>>SET</button>

          </a> <?= $migration['version'] ?> - <?= $migration['filename'] ?>

        </li>

      <?php endforeach; ?>

    </ul>

  </div>

</body>

</html>