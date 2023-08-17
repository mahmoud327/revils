<button
    x-data="<?php echo e(json_encode(['visible' => $visible])); ?>"
	x-show="visible"
    wire:click="clear"
    wire:loading.attr="disabled"
    type="button"
    color="secondary"
    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
        'flex flex-shrink-0 w-10 h-10 rounded-full bg-gray-200 items-center justify-center relative',
        'dark:bg-gray-900' => config('filament.dark_mode'),
    ]); ?>"
    x-tooltip.raw="<?php echo e(__('filament-clear-cache::general.clear_cache')); ?>"
    style="margin-inline-start: 1rem;border-radius:100%;border:none"
>
    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('heroicon-s-trash'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(BladeUI\Icons\Components\Svg::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:loading.remove.delay' => true,'class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-support::components.loading-indicator','data' => ['xCloak' => true,'wire:loading.delay' => true,'wire:target' => 'clear','class' => 'filament-button-icon w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-support::loading-indicator'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-cloak' => true,'wire:loading.delay' => true,'wire:target' => 'clear','class' => 'filament-button-icon w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

    <?php if($cacheChangesCount): ?>
        <span x-cloak
            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                "flex items-center justify-center rounded-full bg-danger-500 text-white text-center overflow-hidden absolute text-xs font-bold",
                "w-5 h-5" => $cacheChangesCount <= 99,
                "w-6 h-6" => $cacheChangesCount > 99,
            ]); ?>"
            style="top:-0.4rem;right:-0.4rem;line-height:1;letter-spacing:-1px;font-size:10px;font-weight:600;word-spacing:-1px;"
        >
            <?php if($cacheChangesCount > 99): ?>
                <span>99<span style="vertical-align:text-top;">+</span></span>
            <?php else: ?>
                <?php echo e($cacheChangesCount); ?>

            <?php endif; ?>
        </span>
    <?php endif; ?>
</button>
<?php /**PATH D:\Programing\awarebox\awarebox-backend\vendor\cms-multi\filament-clear-cache\src\/../resources/views/livewire/clear-cache-button.blade.php ENDPATH**/ ?>