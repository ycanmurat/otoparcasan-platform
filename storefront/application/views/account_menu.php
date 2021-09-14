<div class="col-md-auto">
    <div class="accountPanel">
        <div class="panel-head">
            <div class="Welcome">Merhaba <span><?$writeName=explode(" ", $userInfo->name);echo $writeName[0];?></span></div>
            <div class="user-mail"><?=$userInfo->email?></div>
        </div>
        <div class="panel-content">
            <a href="<?=site_url('hesabim')?>" class="panel-link <?=($tabPanel=='account')?'Active':''?>">
                <div class="Icon"><i class="fa fa-user" aria-hidden="true"></i></div>
                Üyelik Bilgilerim
            </a>
            <a href="<?=site_url('hesabim/sifre')?>" class="panel-link <?=($tabPanel=='password')?'Active':''?>">
                <div class="Icon"><i class="fa fa-key" aria-hidden="true"></i></div>
                Şifre Güncelleme
            </a>
            <a href="<?=site_url('hesabim/siparislerim')?>" class="panel-link <?=($tabPanel=='orders')?'Active':''?>">
                <div class="Icon"><i class="fa fa-cube" aria-hidden="true"></i></div>
                Siparişlerim<span class="Count"><?=$orderCount?></span>
            </a>
            <a href="<?=site_url('hesabim/iadelerim')?>" class="panel-link <?=($tabPanel=='returns')?'Active':''?>">
                <div class="Icon"><i class="fa fa-reply" aria-hidden="true"></i></div>
                İadelerim<span class="Count">3</span>
            </a>
            <a href="<?=site_url('hesabim/urun-sorularim')?>" class="panel-link <?=($tabPanel=='questions')?'Active':''?>">
                <div class="Icon"><i class="fa fa-question-circle" aria-hidden="true"></i></div>
                Ürün Sorularım<span class="Count">3</span>
            </a>
            <a href="<?=site_url('hesabim/adreslerim')?>" class="panel-link <?=($tabPanel=='address')?'Active':''?>">
                <div class="Icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                Adreslerim
            </a>
            <a href="<?=site_url('hesabim/favorilerim')?>" class="panel-link <?=($tabPanel=='favorite')?'Active':''?> ">
                <div class="Icon"><i class="fa fa-heart" aria-hidden="true"></i></div>
                Favorilerim
            </a>
            <a href="<?=site_url('hesabim/garajim')?>" class="panel-link <?=($tabPanel=='garage')?'Active':''?>">
                <div class="Icon"><i class="fa fa-car" aria-hidden="true"></i></div>
                Garajım
            </a>
            <a href="<?=site_url('hesabim/iban-bilgilerim')?>" class="panel-link <?=($tabPanel=='iban')?'Active':''?>">
                <div class="Icon"><i class="fa fa-bank" aria-hidden="true"></i></div>
                IBAN Bilgilerim
            </a>
            <a href="<?=site_url('hesabim/havale-bildirimi')?>" class="panel-link <?=($tabPanel=='transfer')?'Active':''?>">
                <div class="Icon"><i class="fa fa-exchange" aria-hidden="true"></i></div>
                Havale Ödeme Bildirimi
            </a>
            <a href="<?=site_url('hesabim/kuponlarim')?>" class="panel-link <?=($tabPanel=='coupon')?'Active':''?>">
                <div class="Icon"><i class="fa fa-money" aria-hidden="true"></i></div>
                Kuponlarım
            </a>
            <a href="<?=site_url('cikis-yap')?>" class="panel-link">
                <div class="Icon"><i class="fa fa-sign-out" aria-hidden="true"></i></div>
                Çıkış Yap
            </a>
        </div>
    </div>
</div>