    <div class="row">

        <h1>Field inputs for creating new employeer</h1>
    <div class="col-sm-6">
        <div class="container">
            <form method="post" action="/public/home/store">
                <?php
                if (isset($data['error'])){
                    echo $data['error'];
                }
                foreach($data['array'] as $field){
                    ?>
                    <div class="form-group row">
                        <label for="<?= $field ?>" class="col-sm-2 col-form-label"><?= $field ?></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="<?= $field ?>" name="<?= $field ?>" placeholder="<?= $field ?>">
                        </div>
                    </div>
                <?php
                }
                ?>
               
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-4">
                        <button type="submit" class="btn btn-primary" name="submit">Sign in</button>
                    </div>
                </div>
                <?php
                if (isset($data['message'])){
                    echo $data['message'];
                }
                ?>
            </form>
        </div>
    </div>
    </div>