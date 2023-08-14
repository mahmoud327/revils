@php
    $rates = $this->getData();

@endphp
{{ $rates }}
<div x-data="{
    hasHeader: true,

    isLoading: false,

    selectedRecords: [],

    shouldCheckUniqueSelection: true,

    init: function() {
        $wire.on('deselectAllTableRecords', () => this.deselectAllRecords())

        $watch('selectedRecords', () => {
            if (!this.shouldCheckUniqueSelection) {
                this.shouldCheckUniqueSelection = true

                return
            }

            this.selectedRecords = [...new Set(this.selectedRecords)]

            this.shouldCheckUniqueSelection = false
        })
    },

    mountBulkAction: function(name) {
        $wire.mountTableBulkAction(name, this.selectedRecords)
    },

    toggleSelectRecordsOnPage: function() {
        let keys = this.getRecordsOnPage()

        if (this.areRecordsSelected(keys)) {
            this.deselectRecords(keys)

            return
        }

        this.selectRecords(keys)
    },

    getRecordsOnPage: function() {
        let keys = []

        for (checkbox of $el.getElementsByClassName(
                'filament-tables-record-checkbox',
            )) {
            keys.push(checkbox.value)
        }

        return keys
    },

    selectRecords: function(keys) {
        for (key of keys) {
            if (this.isRecordSelected(key)) {
                continue
            }

            this.selectedRecords.push(key)
        }
    },

    deselectRecords: function(keys) {
        for (key of keys) {
            let index = this.selectedRecords.indexOf(key)

            if (index === -1) {
                continue
            }

            this.selectedRecords.splice(index, 1)
        }
    },

    selectAllRecords: async function() {
        this.isLoading = true

        this.selectedRecords = await $wire.getAllSelectableTableRecordKeys()

        this.isLoading = false
    },

    deselectAllRecords: function() {
        this.selectedRecords = []
    },

    isRecordSelected: function(key) {
        return this.selectedRecords.includes(key)
    },

    areRecordsSelected: function(keys) {
        return keys.every((key) => this.isRecordSelected(key))
    },
}" class="filament-tables-component">
    <div
        class="filament-tables-container rounded-xl border border-gray-300 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="filament-tables-header-container" x-show="hasHeader = true || selectedRecords.length">


            <div x-show="true || selectedRecords.length"
                class="filament-tables-header-toolbar flex h-14 items-center justify-between p-2"
                x-bind:class="{
                    'gap-2': false || selectedRecords.length,
                }">
                <div class="flex items-center gap-2">

                    <div class="filament-dropdown filament-tables-bulk-actions" x-show="selectedRecords.length"
                        x-data="{
                            toggle: function(event) {
                                $refs.panel.toggle(event)
                            },
                            open: function(event) {
                                $refs.panel.open(event)
                            },
                            close: function(event) {
                                $refs.panel.close(event)
                            },
                        }" style="display: none;">
                        <div x-on:click="toggle" class="filament-dropdown-trigger cursor-pointer">
                            <button title="فتح الإجراءات" type="button"
                                class="filament-icon-button relative flex items-center justify-center rounded-full outline-none hover:bg-gray-500/5 disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-70 text-primary-500 focus:bg-primary-500/10 dark:hover:bg-gray-300/5 h-10 w-10 filament-tables-bulk-actions-trigger">
                                <span class="sr-only">
                                    فتح الإجراءات
                                </span>

                                <svg wire:loading.remove.delay="" wire:target=""
                                    class="filament-icon-button-icon w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                                    </path>
                                </svg>

                            </button>
                        </div>

                        <div x-ref="panel" x-float.placement.bottom-start.flip.offset="{ offset: 8 }"
                            x-transition:enter-start="scale-95 opacity-0" x-transition:leave-end="scale-95 opacity-0"
                            class="filament-dropdown-panel absolute z-10 w-full divide-y divide-gray-100 rounded-lg bg-white shadow-lg ring-1 ring-black/5 transition dark:divide-gray-700 dark:bg-gray-800 dark:ring-white/10 max-w-[14rem]"
                            style="display: none;">
                            <div class="filament-dropdown-list p-1" dark-mode="dark-mode">
                                <button type="button" wire:loading.attr="disabled"
                                    class="filament-dropdown-list-item filament-dropdown-item group flex w-full items-center whitespace-nowrap rounded-md p-2 text-sm outline-none hover:text-white focus:text-white hover:bg-danger-500 focus:bg-danger-500 filament-tables-bulk-action"
                                    x-on:click="mountBulkAction('delete')">
                                    <svg wire:loading.remove.delay="" wire:target=""
                                        class="filament-dropdown-list-item-icon mr-2 h-5 w-5 rtl:ml-2 rtl:mr-0 group-hover:text-white group-focus:text-white text-danger-500"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>

                                    <span class="filament-dropdown-list-item-label w-full truncate text-start">
                                        حذف المحدد
                                    </span>

                                </button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div wire:key="ujZ424LKBxycw6EglhIo.table.selection.indicator"
            class="filament-tables-selection-indicator flex flex-wrap items-center gap-1 whitespace-nowrap bg-primary-500/10 px-4 py-2 text-sm border-t dark:border-gray-700"
            x-show="selectedRecords.length" style="display: none;">


            <div class="flex-1">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="animate-spin mr-3 inline-block h-4 w-4 text-primary-500 rtl:ml-3 rtl:mr-0" x-show="isLoading"
                    style="display: none;">
                    <path opacity="0.2" fill-rule="evenodd" clip-rule="evenodd"
                        d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                        fill="currentColor"></path>
                    <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z" fill="currentColor"></path>
                </svg>

                <span class="dark:text-white"
                    x-text="
            window.pluralize('{1} \u062a\u0645 \u062a\u062d\u062f\u064a\u062f \u0633\u062c\u0644 \u0648\u0627\u062d\u062f|[3,10] \u062a\u0645 \u062a\u062d\u062f\u064a\u062f :count \u0633\u062c\u0644\u0627\u062a |[2,*] \u062a\u0645 \u062a\u062d\u062f\u064a\u062f :count \u0633\u062c\u0644', selectedRecords.length, {
                count: selectedRecords.length,
            })
        ">
                    تم تحديد سجل واحد</span>

                <span id="ujZ424LKBxycw6EglhIo.table.selection.indicator.record-count.8"
                    x-show="8 !== selectedRecords.length">
                    <button x-on:click="selectAllRecords" class="text-sm font-medium text-primary-600" type="button">
                        تحديد كل السجلات 8.
                    </button>
                </span>

                <span>
                    <button x-on:click="deselectAllRecords" class="text-sm font-medium text-primary-600"
                        type="button">
                        إلغاء تحديد الكل.
                    </button>
                </span>
            </div>


        </div>


        <div class="filament-tables-table-container relative overflow-x-auto dark:border-gray-700 border-t"
            x-bind:class="{
                'rounded-t-xl': !hasHeader,
                'border-t': hasHeader,
            }">
            <table class="filament-tables-table w-full table-auto divide-y text-start dark:divide-gray-700">
                <thead>
                    <tr class="bg-gray-500/5">
                        <td class="filament-tables-checkbox-cell w-4 whitespace-nowrap px-4">
                            <label>
                                <input
                                    class="block rounded border-gray-300 text-primary-600 shadow-sm outline-none focus:ring focus:ring-primary-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-700 dark:checked:border-primary-600 dark:checked:bg-primary-600"
                                    x-on:click="toggleSelectRecordsOnPage"
                                    x-bind:checked="let recordsOnPage = getRecordsOnPage()

                                    if (recordsOnPage.length & amp; & amp; areRecordsSelected(recordsOnPage)) {
                                        $el.checked = true

                                        return 'checked'
                                    }

                                    $el.checked = false

                                    return null"
                                    wire:loading.attr="disabled"
                                    wire:target="previousPage,nextPage,gotoPage,sortTable,tableFilters,resetTableFiltersForm,tableSearchQuery,tableColumnSearchQueries,tableRecordsPerPage"
                                    type="checkbox">

                                <span class="sr-only">
                                    تحديد / إلغاء تحديد كافة العناصر للإجراءات الجماعية.
                                </span>
                            </label>
                        </td>


                        <th class="filament-tables-header-cell p-0 filament-table-header-cell-name">
                            <button wire:click="sortTable('name')" type="button"
                                class="flex w-full items-center gap-x-1 whitespace-nowrap px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 ">
                                <span class="sr-only">
                                    ترتيب حسب
                                </span>

                                <span>
                                    اسم
                                </span>

                                <span class="sr-only">
                                    تصاعدي
                                </span>

                                <svg class="filament-tables-header-cell-sort-icon h-3 w-3 dark:text-gray-300 opacity-25"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg> </button>
                        </th>
                        <th class="filament-tables-header-cell p-0 filament-table-header-cell-color">
                            <button wire:click="sortTable('color')" type="button"
                                class="flex w-full items-center gap-x-1 whitespace-nowrap px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 ">
                                <span class="sr-only">
                                    ترتيب حسب
                                </span>

                                <span>
                                    التقييم
                                </span>

                                <span class="sr-only">
                                    تصاعدي
                                </span>

                                <svg class="filament-tables-header-cell-sort-icon h-3 w-3 dark:text-gray-300 opacity-25"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg> </button>
                        </th>

                        <th class="w-5"></th>
                    </tr>
                </thead>

                <tbody wire:sortable="" wire:end.stop="reorderTable($event.target.sortable.toArray())"
                    wire:sortable.options="{ animation: 100 }"
                    class="divide-y whitespace-nowrap dark:divide-gray-700">
                    @foreach ($rates as $rate)
                        <tr class="filament-tables-row transition hover:bg-gray-50 dark:hover:bg-gray-500/10"
                            wire:key="ujZ424LKBxycw6EglhIo.table.records.1"
                            x-bind:class="{
                                'bg-gray-50 dark:bg-gray-500/10': isRecordSelected('1'),
                            }">
                            <td class="filament-tables-reorder-cell w-4 whitespace-nowrap px-4 hidden">

                            </td>


                            <td class="filament-tables-checkbox-cell w-4 whitespace-nowrap px-4">
                                <label>
                                    <input
                                        class="block rounded border-gray-300 text-primary-600 shadow-sm outline-none focus:ring focus:ring-primary-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-700 dark:checked:border-primary-600 dark:checked:bg-primary-600 filament-tables-record-checkbox"
                                        x-model="selectedRecords" value="1" wire:loading.attr="disabled"
                                        wire:target="previousPage,nextPage,gotoPage,sortTable,tableFilters,resetTableFiltersForm,tableSearchQuery,tableColumnSearchQueries,tableRecordsPerPage"
                                        type="checkbox">

                                    <span class="sr-only">
                                        تحديد / إلغاء تحديد العنصر 1 للإجراءات الجماعية
                                    </span>
                                </label>
                            </td>



                            <td class="filament-tables-cell dark:text-white filament-table-cell-name"
                                wire:key="ujZ424LKBxycw6EglhIo.table.record.1.column.name"
                                wire:loading.remove.delay="wire:loading.remove.delay"
                                wire:target="previousPage,nextPage,gotoPage,sortTable,tableFilters,resetTableFiltersForm,tableSearchQuery,tableColumnSearchQueries,tableRecordsPerPage">
                                <div class="filament-tables-column-wrapper">

                                        <div class="filament-tables-text-column px-4 py-3">

                                            <div class="inline-flex items-center space-x-1 rtl:space-x-reverse">

                                                <span class="">
                                                    {{ $rate->username }}

                                                </span>

                                            </div>

                                        </div>


                                </div>
                            </td>

                            <td class="filament-tables-cell dark:text-white filament-table-cell-color"
                                wire:key="ujZ424LKBxycw6EglhIo.table.record.1.column.color"
                                wire:loading.remove.delay="wire:loading.remove.delay"
                                wire:target="previousPage,nextPage,gotoPage,sortTable,tableFilters,resetTableFiltersForm,tableSearchQuery,tableColumnSearchQueries,tableRecordsPerPage">
                                <div class="filament-tables-column-wrapper">
                                    <a href="http://127.0.0.1:8000/admin/core/categories/1/edit"
                                        class="flex w-full justify-start text-start">
                                        <div class="filament-tables-text-column px-4 py-3">

                                            <div class="inline-flex items-center space-x-1 rtl:space-x-reverse">

                                                <span class="">
                                                    {{ $rate->pivot->relation_value }}

                                                </span>

                                            </div>

                                        </div>

                                    </a>
                                </div>
                            </td>



{{--
                            <td class="w-full animate-pulse px-4 py-4 hidden" colspan="4"
                                wire:loading.class.remove.delay="hidden"
                                wire:key="ujZ424LKBxycw6EglhIo.table.records.1.loading-cell"
                                wire:target="previousPage,nextPage,gotoPage,sortTable,tableFilters,resetTableFiltersForm,tableSearchQuery,tableColumnSearchQueries,tableRecordsPerPage">
                                <div class="h-4 rounded-md bg-gray-300 dark:bg-gray-600"></div>
                            </td> --}}
                        </tr>
                    @endforeach




                </tbody>

            </table>
        </div>

        {{-- <div class="filament-tables-pagination-container border-t p-2 dark:border-gray-700">
            <nav role="navigation" aria-label="التنقل بين الصفحات"
                class="filament-tables-pagination flex items-center justify-between">
                <div class="flex flex-1 items-center justify-between lg:hidden">
                    <div class="w-10">
                    </div>

                    <div
                        class="filament-tables-pagination-records-per-page-selector flex items-center space-x-2 rtl:space-x-reverse">
                        <label>
                            <select wire:model="tableRecordsPerPage"
                                class="h-8 rounded-lg border-gray-300 pr-8 text-sm leading-none shadow-sm outline-none transition duration-75 focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-primary-500">
                                <option value="5">
                                    5
                                </option>
                                <option value="10">
                                    10
                                </option>
                                <option value="25">
                                    25
                                </option>
                                <option value="50">
                                    50
                                </option>
                                <option value="-1">
                                    الكل
                                </option>
                            </select>

                            <span class="text-sm font-medium dark:text-white">
                                لكل صفحة
                            </span>
                        </label>
                    </div>

                    <div class="w-10">
                    </div>
                </div>

                <div class="hidden flex-1 grid-cols-3 items-center lg:grid">
                    <div class="flex items-center">
                        <div class="pl-2 text-sm font-medium dark:text-white">
                            عرض 1 إلي 8 من 8 نتائج
                        </div>
                    </div>

                    <div class="flex items-center justify-center">
                        <div
                            class="filament-tables-pagination-records-per-page-selector flex items-center space-x-2 rtl:space-x-reverse">
                            <label>
                                <select wire:model="tableRecordsPerPage"
                                    class="h-8 rounded-lg border-gray-300 pr-8 text-sm leading-none shadow-sm outline-none transition duration-75 focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-primary-500">
                                    <option value="5">
                                        5
                                    </option>
                                    <option value="10">
                                        10
                                    </option>
                                    <option value="25">
                                        25
                                    </option>
                                    <option value="50">
                                        50
                                    </option>
                                    <option value="-1">
                                        الكل
                                    </option>
                                </select>

                                <span class="text-sm font-medium dark:text-white">
                                    لكل صفحة
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center justify-end">
                    </div>
                </div>
            </nav>
        </div> --}}
    </div>

    <form wire:submit.prevent="callMountedTableAction">

        <div x-data="{
            isOpen: false,

            livewire: null,

            close: function() {
                this.isOpen = false

                this.$refs.modalContainer.dispatchEvent(
                    new CustomEvent('modal-closed', { id: 'ujZ424LKBxycw6EglhIo-table-action' }),
                )
            },

            open: function() {
                this.isOpen = true

                this.$refs.modalContainer.dispatchEvent(
                    new CustomEvent('modal-opened', { id: 'ujZ424LKBxycw6EglhIo-table-action' }),
                )
            },
        }" x-trap.noscroll="isOpen"
            x-on:close-modal.window="if ($event.detail.id === 'ujZ424LKBxycw6EglhIo-table-action') close()"
            x-on:open-modal.window="if ($event.detail.id === 'ujZ424LKBxycw6EglhIo-table-action') open()"
            role="dialog" aria-modal="true" class="filament-modal block" wire:ignore.self="">


            <div x-show="isOpen" x-transition.duration.300ms.opacity=""
                class="fixed inset-0 z-40 min-h-full overflow-y-auto overflow-x-hidden transition flex items-center"
                style="display: none;">
                <div x-on:click="$dispatch('close-modal', { id: 'ujZ424LKBxycw6EglhIo-table-action' })"
                    aria-hidden="true"
                    class="filament-modal-close-overlay fixed inset-0 h-full w-full bg-black/50 cursor-pointer"></div>

                <div x-ref="modalContainer"
                    class="pointer-events-none relative w-full cursor-pointer transition my-auto p-4"
                    x-init="livewire = $wire.__instance"
                    x-on:modal-closed.stop="if ('mountedTableAction' in livewire?.serverMemo.data) {
                livewire.set('mountedTableAction', null)
            }

            if ('mountedTableActionRecord' in livewire?.serverMemo.data) {
                livewire.set('mountedTableActionRecord', null)
            }">
                    <div x-data="{ isShown: false }" x-init="$nextTick(() => {
                        isShown = isOpen
                        $watch('isOpen', () => (isShown = isOpen))
                    })" x-show="isShown"
                        x-on:keydown.window.escape="$dispatch('close-modal', { id: 'ujZ424LKBxycw6EglhIo-table-action' })"
                        x-transition:enter="ease duration-300" x-transition:leave="ease duration-300"
                        x-transition:enter-start="translate-y-8" x-transition:enter-end="translate-y-0"
                        x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-8"
                        class="filament-modal-window pointer-events-auto w-full cursor-default bg-white py-2 dark:bg-gray-800 relative mx-auto rounded-xl hidden max-w-sm"
                        style="display: none;">
                        <button tabindex="-1" type="button"
                            class="absolute right-2 top-2 rtl:left-2 rtl:right-auto"
                            x-on:click="$dispatch('close-modal', { id: 'ujZ424LKBxycw6EglhIo-table-action' })">
                            <svg title="Close" tabindex="-1"
                                class="filament-modal-close-button h-4 w-4 cursor-pointer text-gray-400"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">
                                Close
                            </span>
                        </button>

                        <div class="">
                            <div class="space-y-2">

                            </div>

                            <div class="filament-modal-content space-y-2 p-2">



                            </div>

                            <div class="space-y-2">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form wire:submit.prevent="callMountedTableBulkAction">

        <div x-data="{
            isOpen: false,

            livewire: null,

            close: function() {
                this.isOpen = false

                this.$refs.modalContainer.dispatchEvent(
                    new CustomEvent('modal-closed', { id: 'ujZ424LKBxycw6EglhIo-table-bulk-action' }),
                )
            },

            open: function() {
                this.isOpen = true

                this.$refs.modalContainer.dispatchEvent(
                    new CustomEvent('modal-opened', { id: 'ujZ424LKBxycw6EglhIo-table-bulk-action' }),
                )
            },
        }" x-trap.noscroll="isOpen"
            x-on:close-modal.window="if ($event.detail.id === 'ujZ424LKBxycw6EglhIo-table-bulk-action') close()"
            x-on:open-modal.window="if ($event.detail.id === 'ujZ424LKBxycw6EglhIo-table-bulk-action') open()"
            role="dialog" aria-modal="true" class="filament-modal block" wire:ignore.self="">


            <div x-show="isOpen" x-transition.duration.300ms.opacity=""
                class="fixed inset-0 z-40 min-h-full overflow-y-auto overflow-x-hidden transition flex items-center"
                style="display: none;">
                <div x-on:click="$dispatch('close-modal', { id: 'ujZ424LKBxycw6EglhIo-table-bulk-action' })"
                    aria-hidden="true"
                    class="filament-modal-close-overlay fixed inset-0 h-full w-full bg-black/50 cursor-pointer"></div>

                <div x-ref="modalContainer"
                    class="pointer-events-none relative w-full cursor-pointer transition my-auto p-4"
                    x-init="livewire = $wire.__instance"
                    x-on:modal-closed.stop="if ('mountedTableBulkAction' in livewire?.serverMemo.data) livewire.set('mountedTableBulkAction', null)">
                    <div x-data="{ isShown: false }" x-init="$nextTick(() => {
                        isShown = isOpen
                        $watch('isOpen', () => (isShown = isOpen))
                    })" x-show="isShown"
                        x-on:keydown.window.escape="$dispatch('close-modal', { id: 'ujZ424LKBxycw6EglhIo-table-bulk-action' })"
                        x-transition:enter="ease duration-300" x-transition:leave="ease duration-300"
                        x-transition:enter-start="translate-y-8" x-transition:enter-end="translate-y-0"
                        x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-8"
                        class="filament-modal-window pointer-events-auto w-full cursor-default bg-white py-2 dark:bg-gray-800 relative mx-auto rounded-xl hidden max-w-sm"
                        style="display: none;">
                        <button tabindex="-1" type="button"
                            class="absolute right-2 top-2 rtl:left-2 rtl:right-auto"
                            x-on:click="$dispatch('close-modal', { id: 'ujZ424LKBxycw6EglhIo-table-bulk-action' })">
                            <svg title="Close" tabindex="-1"
                                class="filament-modal-close-button h-4 w-4 cursor-pointer text-gray-400"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">
                                Close
                            </span>
                        </button>

                        <div class="">
                            <div class="space-y-2">

                            </div>

                            <div class="filament-modal-content space-y-2 p-2">



                            </div>

                            <div class="space-y-2">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
