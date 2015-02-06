    <!--page style
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/service/newstyle.css" media="screen, projection">-->
    
    
    <section class="white-bg services">
        <?php if ($space): $i = 1; ?>
            <div class="row">
                <?php foreach ($space as $row): ?>
                    <a href="<?php echo base_url() ?>space/detail/<?php echo $row->slug; ?>" class="serv-bl">
                        <div style="background-image: url('<?php echo base_url() ?>assets/uploads/space/<?php echo $row->image ?>');" class="half-block tofade animated flipInY" style="opacity: 0;">
                            <div class="inner p-90">
                                <div class="text"><?php echo $row->title; ?></div>
                            </div>
                        </div>        
                    </a>
                    <?php if ($i%3 == 0): ?>
                        </div><div class="row">
                    <?php endif; $i++; ?>
                <?php endforeach ?>
            </div>
        <?php endif ?>

           <?php /* ?>
            <div class="row">
                <a href="#" class="serv-bl">
                    <div style="background-image: url(assets/uploads/space/header_amenties3.png);" class="half-block tofade animated flipInY" style="opacity: 0;">
                        <div class="inner p-90">
                            <div class="text">Design and realization of<br>complete interior and kitchen</div>
                        </div>
                    </div>        
                </a>
                <a href="#" class="serv-bl">
                    <div style="background-image: url(assets/uploads/space/header_capacities3.png);" class="half-block tofade animated flipInY" style="opacity: 0;">
                        <div class="inner p-90">
                            <div class="text">Fitting interior with furniture</div>
                        </div>
                    </div>        
                </a>
                <a href="#" class="serv-bl">
                    <div style="background-image: url(assets/uploads/space/header_film.png);" class="half-block tofade animated flipInY" style="opacity: 0;">
                        <div class="inner p-90">
                            <div class="text">A specialist in Miele appliances </div>
                        </div>
                    </div>        
                </a>
            </div>
            <div class="row">
                <a href="#" class="serv-bl">
                    <div style="background-image: url(assets/uploads/space/header_amenties3.png);" class="half-block tofade animated flipInY" style="opacity: 0;">
                        <div class="inner p-90">
                            <div class="text">Design and realization of<br>complete interior and kitchen</div>
                        </div>
                    </div>        
                </a>
                <a href="#" class="serv-bl">
                    <div style="background-image: url(assets/uploads/space/header_capacities3.png);" class="half-block tofade animated flipInY" style="opacity: 0;">
                        <div class="inner p-90">
                            <div class="text">Fitting interior with furniture</div>
                        </div>
                    </div>        
                </a>
                <a href="#" class="serv-bl">
                    <div style="background-image: url(assets/uploads/space/header_film.png);" class="half-block tofade animated flipInY" style="opacity: 0;">
                        <div class="inner p-90">
                            <div class="text">A specialist in Miele appliances </div>
                        </div>
                    </div>        
                </a>
            </div>
            <div class="row">
                <a href="#" class="serv-bl">
                    <div style="background-image: url(assets/uploads/space/header_amenties3.png);" class="half-block tofade animated flipInY" style="opacity: 0;">
                        <div class="inner p-90">
                            <div class="text">Design and realization of<br>complete interior and kitchen</div>
                        </div>
                    </div>        
                </a>
                <a href="#" class="serv-bl">
                    <div style="background-image: url(assets/uploads/space/header_capacities3.png);" class="half-block tofade animated flipInY" style="opacity: 0;">
                        <div class="inner p-90">
                            <div class="text">Fitting interior with furniture</div>
                        </div>
                    </div>        
                </a>
                <a href="#" class="serv-bl">
                    <div style="background-image: url(assets/uploads/space/header_film.png);" class="half-block tofade animated flipInY" style="opacity: 0;">
                        <div class="inner p-90">
                            <div class="text">A specialist in Miele appliances </div>
                        </div>
                    </div>        
                </a>
            </div>

            <div class="row">
                <a href="#" class="serv-bl">
                    <div style="background-image: url(assets/uploads/space/header_amenties3.png);" class="half-block tofade animated flipInY" style="opacity: 0;">
                        <div class="inner p-90">
                            <div class="text">Design and realization of<br>complete interior and kitchen</div>
                        </div>
                    </div>        
                </a>
                <a href="#" class="serv-bl">
                    <div style="background-image: url(assets/uploads/space/header_capacities3.png);" class="half-block tofade animated flipInY" style="opacity: 0;">
                        <div class="inner p-90">
                            <div class="text">Fitting interior with furniture</div>
                        </div>
                    </div>        
                </a>
                <a href="#" class="serv-bl">
                    <div style="background-image: url(assets/uploads/space/header_film.png);" class="half-block tofade animated flipInY" style="opacity: 0;">
                        <div class="inner p-90">
                            <div class="text">A specialist in Miele appliances </div>
                        </div>
                    </div>        
                </a>
            </div>
             */ ?>
        </section> 
    
   

<style>
.serv-page .navbar-statica{
    height: 220px !important;
}
.serv-page .navbar-statica .navbar-nav{
    margin-top: 160px;
}
.navbar-statica .navbar-header .navbar-brand {
    margin-top:30px !important;
}
</style>