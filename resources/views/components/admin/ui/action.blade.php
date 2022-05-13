@if ($list_item)
    @php
        $user = true;
        $filtered = collect([]);
    @endphp
    <div class="text-center">
        @if ($filtered->count() > 0 || $user)
            <span class="dropdown">
                <a href="javascript:void(0)" class="" style="font-size: 22px;" data-toggle="dropdown"
                    aria-expanded="false">
                    <i class='fas fa-ellipsis-h'></i>
                </a>
                @if (isset($list_item))
                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                        @foreach ($list_item as $item)
                            @if ($item->get('permission') != false || $user)
                                <a class="dropdown-item {{ $item->get('target', null) ? 'call-model' : '' }} {{ $item->get('class', null) }}"
                                    @if ($item->get('target', null)) data-target-modal="{{ $item->get('target') }}" @endif
                                    data-id="{{ $item->get('id', null) }}"
                                    data-url="{{ $item->get('action', 'javaqscrip:void(0)') }}"
                                    href="{{ $item->get('action', 'javaqscrip:void(0)') }}"
                                    @if ($item->get('attrs', null)) @foreach ($item->get('attrs') as $key => $attr)
                                                {{ $key }}="{{ $attr }}"
                                            @endforeach @endif><i
                                        class="{{ $item->get('icon') }}"></i>&nbsp;&nbsp;{{ $item->get('text') }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                @endif
            </span>
        @endif
    </div>
@endif
