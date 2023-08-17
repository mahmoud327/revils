<?php
    $url = $getUrl();
?>

<?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.stats.card','data' => ['tag' => $url ? 'a' : 'div','chart' => $getChart(),'chartColor' => $getChartColor(),'color' => $getColor(),'icon' => $getIcon(),'description' => $getDescription(),'descriptionColor' => $getDescriptionColor(),'descriptionIcon' => $getDescriptionIcon(),'descriptionIconPosition' => $getDescriptionIconPosition(),'href' => $url,'target' => $shouldOpenUrlInNewTab() ? '_blank' : null,'label' => $getLabel(),'value' => $getValue(),'extraAttributes' => $getExtraAttributes(),'class' => 'filament-stats-overview-widget-card']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::stats.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tag' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($url ? 'a' : 'div'),'chart' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getChart()),'chart-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getChartColor()),'color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getColor()),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getIcon()),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getDescription()),'description-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getDescriptionColor()),'description-icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getDescriptionIcon()),'description-icon-position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getDescriptionIconPosition()),'href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($url),'target' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($shouldOpenUrlInNewTab() ? '_blank' : null),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getLabel()),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getValue()),'extra-attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getExtraAttributes()),'class' => 'filament-stats-overview-widget-card']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\awarebox-backend\vendor\filament\filament\src\/../resources/views/widgets/stats-overview-widget/card.blade.php ENDPATH**/ ?>