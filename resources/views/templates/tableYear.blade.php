@php
	$weekNames = ["I", "II", "III", "IV", "V", "VI"];
	$dayNames = ["", "ПОНЕДІЛОК", "ВІВТОРОК", "СЕРЕДА", "ЧЕТВЕР", "П’ЯТНИЦЯ", "СУБОТА"];
	$monthNames = [
		'1' => 'Січень',
		'2' => 'Лютий',
		'3' => 'Березень',
		'4' => 'Квітень',
		'5' => 'Травень',
		'6' => 'Червень',
		'9' => 'Вересень',
		'10' => 'Жовтень',
		'11' => 'Листопад',
		'12' => 'Грудень',
	];

@endphp

<h3 class="list__periodHead">ВІДОМІСТЬ ВІДВІДУВАННЯ ЗА СЕМЕСТР</h3>

@include('templates.tableFilter')

<div id="sheet__container">
	<div id="sheet" class="sheet">
		@include('templates.tableSortRow')
		<div class="sheet__content">
			<div class="sheet__headRow">
				<div class="sheet__cell cell-n color-primary">№</div>
				<div class="sheet__cell cell-name color-primary">ПРІЗВИЩЕ ТА ІНІЦІАЛИ СТУДЕНТА</div>
				<div class="sheet__days">
					@foreach ($days_sorted as $key => $month)
						<div class="cell-day {{"col-". $loop->iteration}} {{$loop->first ? 'visible' : ''}}">
							<div class="sheet__dayName color-primary">{{$monthNames[$key]}}</div>
							<div class="sheet__disciples">
								@foreach ($month as $week)
									<div class="sheet__cell sheet__disciple color-secondary">
										<span class="rotated center">
											<span class="discipleNameText">{{$weekNames[$loop->index] . ' тиждень'}}</span>
										</span>
									</div>
								@endforeach
							</div>
						</div>
					@endforeach
				</div>
				<div class="sheet__cell cell-skips color-primary col-999">
					<div class="rotated">
						ПРОПУСКИ ПО <br> ПОВАЖНІЙ ПРИЧИНІ
					</div>
				</div>
				<div class="sheet__cell cell-skips color-primary col-999">
					<div class="rotated">
						ПРОПУСКИ БЕЗ <br> ПОВАЖНОЇ ПРИЧИНИ
					</div>
				</div>
				<div class="sheet__cell cell-skips color-primary col-999">
					<div class="rotated">
						ЗАГАЛЬНА КІЛЬКІСТЬ <br> ПРОПУСКІВ
					</div>
				</div>
			</div>
	
			@if (!$users->isEmpty())
				@foreach ($users as $user)
					<div class="sheet__itemRow">
						<div class="sheet__cell cell-n color-secondary">{{$loop->iteration}}</div>
						<div class="sheet__cell cell-name color-secondary">
							@php 
								$initials = mb_substr($user->name, 0 , 1). '.';
								$initials .= mb_substr($user->patronymic, 0 , 1). '.';
							@endphp
							{{$user->surname. '. ' . $initials}}
						</div>
						<div style="display:flex;">
							@php
								$pp = 0;
								$bp = 0;
							@endphp
							@foreach ($days_sorted as $month)
								<div class="sheet__itemDaySkips {{"col-". $loop->iteration}} {{$loop->first ? 'visible' : ''}}">
									@foreach ($month as $week)
										@php
											$userSkip = $skips_sorted[$user->id][$week] ?? '';
											if(empty($userSkip)){
												$userSkip = '';
											} else {
												$pp += $userSkip->pp;
												$bp += $userSkip->bp;
												$userSkip = $userSkip->pp + $userSkip->bp == 0 ? '' : $userSkip->pp + $userSkip->bp;
											}
										@endphp
										<div class="sheet__cell cell-skip">{{$userSkip}}</div>
									@endforeach
								</div>
							@endforeach
						</div>
						<div class="sheet__cell cell-skips ppCount col-999">{{$pp}}</div>
						<div class="sheet__cell cell-skips bpCount col-999">{{$bp}}</div>
						<div class="sheet__cell cell-skips sumCount col-999">{{$pp+$bp}}</div>
					</div>
				@endforeach
			@endif
		</div>
			</div>
</div>

<div class="switcher list__switch" data-table="table-1">
	@for ($i = 0; $i < count($days_sorted); $i++)
		<div class="switcherCase list__switchCase {{$i == 0 ? 'active' :''}}" data-col="col-{{$i+1}}"></div>
	@endfor
	<div class="switcherCase list__switchCase" data-col="col-999"></div>
</div>

<div class="sheetSwitch">
	<div class="sheetSwitch__button" data-val="week"><span class="mob-no">ВІДОМІСТЬ</span> ЗА ТИЖДЕНЬ</div>
	<div class="sheetSwitch__button" data-val="month"><span class="mob-no">ВІДОМІСТЬ</span> ЗА МІСЯЦЬ</div>
	<div class="sheetSwitch__button sheetSwitch__button-active" data-val="semester"><span class="mob-no">ВІДОМІСТЬ</span> ЗА СЕМЕСТР</div>
</div>

<div class="controlBlock list__edit">
	<div class="select list__period" data-type="semester">
		<div class="select__wrapper">
			@php
				switch ($arr['period']) {
					case 1:
						$period = 'І семестр';
						break;
					case 2:
						$period = 'ІІ семестр';
						break;
					
					default:
						$period = 'Виберіть семестр';
						break;
				}
			@endphp
			<div class="select__item select__item-first {{$arr['period'] == 1 || $arr['period'] == 2 ? 'select__item-active' : ''}}" data-id="{{date('n') < 9 ? 1 : 2}}">{{$period}}</div>
			<div class="select__item" data-id="1">І семестр</div>
			<div class="select__item" data-id="2">ІІ семестр</div>
		</div>
	</div>

	<div class="m-auto"></div>

	@if ($permission > 3)
		<button class="list__submit button-cancel list__sendSubmit button-mail">РОЗІСЛАТИ</button>
	@endif
	<button class="list__submit button-ok list__exelExport button-download">ЗАВАНТАЖИТИ EXCEL</button>
</div>

@include('templates.listPageOverlay')

<script src="{{ URL::asset('js/list.min.js') }}"></script>