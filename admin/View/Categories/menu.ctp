 <div class="row">
    <div class="col-lg-12">
        <div class="row table-header-row">
            <div class="card-heading datatable-heading">
                <?php echo $this->Html->link('<i class="icon-list"></i> All ', array('controller' => $controller, 'action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
                <?php echo $this->Html->link('<i class="icon-plus-sign-alt"></i> Add New', array('controller' => $controller, 'action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
            </div>    
        </div>    
    </div>
</div>