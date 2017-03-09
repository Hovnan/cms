<h1>Employees List</h1>

<button id="open" onclick="showList(this)">Import given/attached JSON data of employees</button>
<div id="info"></div>
<div class="row">
    <div class="col-lg-6 col-lg-offset-6">
        <form action="/public/home/search" method="post">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for..." name="result">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit" name="search">Go!</button>
      </span>
        </div><!-- /input-group -->
        </form>
    </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
<a href="/public/home/create" class="btn btn-success">Create new employeer</a>
<table class="table table-hover">
    <thead>
    <tr>
        <th>#</th>
        <?php foreach($fields as $field){ ?>
        <th><?= $field ?></th>
        <?php } ?>
        <th>edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($data as $ks => $vs){?>

    <tr>
        <th scope="row"><?= $ks ?></th>
        <?php foreach($fields as $field){ ?>

        <td><?= $vs->$field ?></td>

    <?php } ?>

        <td><a href="/public/home/update/<?= $ks ?>" class="btn btn-xs btn-primary">edit</a></td>
        <td><a href="/public/home/delete/<?= $ks ?>" class="btn btn-xs btn-danger">delete</a></td>
    </tr>
    <?php } ?>
    </tbody>
</table>