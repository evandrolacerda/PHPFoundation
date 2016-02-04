
<hr>
<ul class="nav nav-tabs">
    <li role="presentation"><a href="<?php echo url('/admin');?>">Admin Index</a></li>
    <li role="presentation"><a href="<?php echo url('/admin/empresa');?>">Gerenciar Empresa</a></li>
    <li role="presentation"><a href="<?php echo url('/admin/produtos');?>">Gerenciar Produtos</a></li>
    <li role="presentation"><a href="<?php echo url('/admin/servicos');?>">Gerenciar Serviços</a></li>
    <li role="presentation"><a href="<?php echo url('/admin/login?', ['action' => 'logout']);?>">Logout</a></li>
</ul>