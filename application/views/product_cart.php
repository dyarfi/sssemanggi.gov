<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row">
<?php echo form_open('cart/send_order',['id'=>'form_order']);?>
<fieldset><legend class="bold"><h5>Form Pemesanan</h5></legend>
        <?php echo form_hidden('product_id',$product->subject); ?>
        <div class="field twelve columns">
            <label class="bold">Produk :</label>
            <?php echo $product->subject;?>
        </div>
        <?php if ($product->model) { ?>        
        <div class="field twelve columns">
            <label class="bold" for="model">Model :</label>   
            <div class="picker">
                <select name="model" id="model">
                    <?php 
                    foreach ($product->model as $model) {
                        $models[$model->id] = [$model->subject];
                        echo '<option value="'.$model->subject.' - Rp '.$model->price.'">'.$model->subject.' - Rp '.$model->price.'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <?php } else { ?>
        <div class="field twelve columns">
            <label class="bold">Harga :</label>
            <?php 
            $price = json_decode($product->attribute);
            echo ('Rp. '.$price->price->price_range->value);
            echo form_hidden('model', 'Rp. '.$price->price->price_range->value);
            ?>
        </div>
        <?php } ?>

        <?php if ($variant) { ?> 
        <div class="field twelve columns">
            <label class="bold">Variant :</label>
            <?php if ($variant->media) { ?> 
            <div class="text-center"><?php echo $variant->subject;?></div>
            <img src="<?php echo base_url($variant->media);?>" alt="<?php echo $variant->subject;?>">
            <?php 
                echo form_hidden('variant',$variant->subject);
            } ?>        
        </div>
        <?php } else { ?>
            <img src="<?php echo base_url('uploads/'.$product->type.'/'.$product->media_plain);?>" alt="<?php echo $product->subject;?>"/>
        <?php } ?>
        <hr class="thin grey"/>
        <div class="field ten columns">
            <label class="bold" for="name">Nama : <span></span></label>
            <input type="text" name="name" id="name" class="input">
        </div>
        <div class="field ten columns">
            <label class="bold" for="email">Email : <span></span></label>
            <input type="text" name="email" id="email" class="input">
        </div>    
        <div class="field ten columns">
            <label class="bold" for="phone">Telepon : <span></span></label>
            <input type="text" name="phone" id="phone" class="input">
        </div>
        <div class="field twelve columns">
            <label class="bold" for="address">Alamat : <span></span></label>
            <textarea name="address" class="input textarea" id="address" rows="4"></textarea>
        </div>
        <div class="twelve columns field">
            <label for="captcha" class="bold"><?php echo lang('captcha');?> : <span></span></label>
            <div class="twelve">
                <input type="text" name="captcha" class="input four columns" id="captcha" value="<?php echo $fields->captcha;?>">
                <a class="reload_captcha four columns" rel="<?php echo base_url('xhr/reload_captcha')?>" href="javascript:;"><?php echo $this->Captcha->image()['image'];?></a>
            </div>
            <div class="row">
                <div class="twelve columns">
                    <?php echo $errors['captcha'];?>
                </div>
            </div>
        </div>      
        <ul class="field twelve columns">
            <li>* Harga berikut untuk wilayah JABODETABEK.</li>
            <li>* Harga belum termasuk PPn.</li>
        </ul>
        <div class="twelve columns field">
            <div class="warning light note"></div>
        </div>
</fieldset>
<button type="submit" class="purple fill-button"><span class="fa fa-shopping-cart" aria-hidden="true"></span>&nbsp;&nbsp;Pesan</button>
<?php 
echo form_close();?>
</div>