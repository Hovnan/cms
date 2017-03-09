<div class="row">
    <h1>Update employeer's data</h1>
    <div class="col-sm-6">
        <div class="container">
            <form method="post" action="/public/home/edit/<?= $data['ident'] ?>">
                <?php
               /* if (isset($data['error'])){
                    echo $data['error'];
                }*/
                foreach($fields as $field){

                    //foreach($datas as $data){
                    //echo $value->name;
                    ?>
                    <div class="form-group row">
                        <label for="<?= $field ?>" class="col-sm-2 col-form-label"><?= $field ?></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="<?= $data[$field]  ?>" name="<?= $field  ?>" placeholder="" value="<?=$data[$field] ?>">
                        </div>
                    </div>
                    <?php
               // }
                }
                ?>

                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-4">
                        <button type="submit" class="btn btn-primary" name="submit">Sign in</button>
                    </div>
                </div>
                <?php/*
                if (isset($data['message'])){
                    echo $data['message'];
                }*/
                ?>
            </form>
        </div>
    </div>
</div>