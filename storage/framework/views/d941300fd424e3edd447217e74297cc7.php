<div class="relative">
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('filament-clear-cache::clear-cache-button')->html();
} elseif ($_instance->childHasBeenRendered('l3837750300-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l3837750300-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l3837750300-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l3837750300-0');
} else {
    $response = \Livewire\Livewire::mount('filament-clear-cache::clear-cache-button');
    $html = $response->html();
    $_instance->logRenderedChild('l3837750300-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
</div><?php /**PATH D:\Programing\awarebox\awarebox-backend\vendor\cms-multi\filament-clear-cache\src\/../resources/views/widgets/toolbar-menu.blade.php ENDPATH**/ ?>