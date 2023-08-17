<?php
    $data = $this->getData();
?>
<?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.page','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::page'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.card.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
        <div class="title">

            <h1> <?php echo app('translator')->get('dashboard.products.name'); ?>:-<?php echo e($data->name); ?></h1>
        </div>





        <div class="content">
            <ul>
                  <li><?php echo app('translator')->get('dashboard.products.user'); ?>:<?php echo e(optional($data->user)->name); ?></li>
                <li><?php echo app('translator')->get('dashboard.products.category'); ?>:<?php echo e(optional($data->category)->name); ?></li>
                <li><?php echo app('translator')->get('dashboard.products.quantity'); ?>:<?php echo e($data->quantity); ?></li>
                <li><?php echo app('translator')->get('dashboard.products.item type'); ?>:<?php echo e($data->item_type); ?></li>
                <li><?php echo app('translator')->get('dashboard.products.unit'); ?>:<?php echo e($data->unit); ?></li>
                <li><?php echo app('translator')->get('dashboard.products.status'); ?>:<?php echo e($data->getStatus()); ?></li>
                <li><?php echo app('translator')->get('dashboard.products.cash'); ?>:<?php echo e($data->cash); ?></li>
                <li><?php echo app('translator')->get('dashboard.products.is free shipping'); ?>:<?php echo e($data->getIsFreeShipping()); ?></li>
                <li><?php echo app('translator')->get('dashboard.products.is handcrafted'); ?>:<?php echo e($data->getIsHandcrafted()); ?></li>
                <li><?php echo app('translator')->get('dashboard.products.is batteries shipping'); ?>:<?php echo e($data->getIsBatteriesShipping()); ?></li>
                <li><?php echo app('translator')->get('dashboard.products.is liquid shipping'); ?>:<?php echo e($data->getIsLiquidShipping()); ?></li>
                <li><?php echo app('translator')->get('dashboard.products.is dangerous shipping'); ?>:<?php echo e($data->getIsDangerousShipping()); ?></li>
                <li><?php echo app('translator')->get('dashboard.products.weight'); ?>:<?php echo $data->weight; ?> </li>
                <li><?php echo app('translator')->get('dashboard.products.price'); ?>:<?php echo $data->price; ?> </li>
                <li><?php echo app('translator')->get('dashboard.description'); ?>:<?php echo $data->description; ?> </li>

                <ul>
                    <li><?php echo app('translator')->get('dashboard.products.attributes'); ?> </li>
                    <?php $__currentLoopData = $data->attributeValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e(optional( $attribute->attribute)->name); ?>:

                        <?php echo e($attribute->value); ?><br><br>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>



            </ul>

        </div>


     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

<style>
    .title {
        font-size: 30px;
    }

    .content {
        margin: 30px;
    }

    .content ul {
        list-style-type: circle;
    }

    .content ul li {
        padding: 5px;
        font-size: 20px;
        border-bottom-style: dotted;
        border-bottom-color: red;
    }
</style>
<?php /**PATH C:\laragon\www\awarebox-backend\resources\views/products/show.blade.php ENDPATH**/ ?>