@if (empty($groupID))
	@if (empty($rType))
		@include('templates.groupNotFound')
	@endif
@else
	@if (!empty($users))
		<input id="institutionName" type="hidden" value="{{$institutionName}}">

		@if (array_key_exists('5', $users))
			<h4 class="group__tableDesc">ІНФОРМАЦІЯ ПРО ЗАВІДУЮЧОГО ВІДДІЛЕННЯМ</h4>
			<div class="group__table table-5">
				<div class="group__row">
					<div class="group__th group__tdID">№</div>
					<div class="group__th group__tdName">ПРІЗВИЩЕ <br> ТА ІНІЦІАЛИ</div>
					<div class="group__th col-1 visible">ДАТА <br> НАРОДЖЕННЯ</div>
					<div class="group__th col-2">МОБІЛЬНИЙ <br> ТЕЛЕФОН</div>
					<div class="group__th col-3">E-MAIL <br> АДРЕС</div>
					<div class="group__th col-4">ОТРИМУЄ <br> СТИПЕНДІЮ</div>
				</div>
				
				@foreach ($users['5'] as $user)
					@if ($permission > 4)
						<div class="group__row userRow editable" data-id="{{$user->id}}">
							<div class="group__td group__tdID">{{$loop->iteration}}</div>
							<div class="group__td group__tdName">
								@php 
									$initials = mb_substr($user->name, 0 , 1). '.' . mb_substr($user->patronymic, 0 , 1). '.';
								@endphp
								<div class="userName">{{$user->surname . ' ' . $initials}}</div>
								<div class="group__delete" data-id="{{$user->id}}"></div>
							</div>
							<div class="group__td col-1 visible">
								@php
									$dob = new DateTime($user->dayOfBirth);
								@endphp
								<div class="group__text">{{$dob->format('d-m-Y')}}</div>
								<input type="text" class="inputText group__input userDofB">
							</div>
							<div class="group__td col-2">
								<div class="group__text">{{$user->phone}}</div>
								<input type="text" class="inputText group__input userPhone">
							</div>
							<div class="group__td col-3">
								<div class="group__text">{{$user->email}}</div>
								<input type="text" class="inputText group__input userEmail">
							</div>
							<div class="group__td col-4">
								<div class="group__text">{{$user->grant == 0 ? 'НІ' : 'ТАК'}}</div>
								<div class="group__grant">
									<div class="group__radios">
										<div class="group__radio"><input class="radioNO" type="radio" name="grant{{$user->id}}" value="0" data-val="НІ">НІ</div>
										<div class="group__radio"><input class="radioYES" type="radio" name="grant{{$user->id}}" value="1" data-val="ТАК">ТАК</div>
									</div>
								</div>
							</div>
						</div>
					@else
						<div class="group__row userRow" data-id="{{$user->id}}">
							<div class="group__td group__tdID">{{$loop->iteration}}</div>
							<div class="group__td group__tdName">
								@php 
									$initials = mb_substr($user->name, 0 , 1). '.' . mb_substr($user->patronymic, 0 , 1). '.';
								@endphp
								<div class="userName">{{$user->surname . ' ' . $initials}}</div>
							</div>
							<div class="group__td col-1 visible">
								@php
									$dob = new DateTime($user->dayOfBirth);
								@endphp
								<div class="group__text">{{$dob->format('d-m-Y')}}</div>
							</div>
							<div class="group__td col-2">
								<div class="group__text">{{$user->phone}}</div>
							</div>
							<div class="group__td col-3">
								<div class="group__text">{{$user->email}}</div>
							</div>
							<div class="group__td col-4">
								<div class="group__text">{{$user->grant == 0 ? 'НІ' : 'ТАК'}}</div>
							</div>
						</div>
					@endif

				@endforeach
			</div>

			<div class="switcher group__switch" data-table="table-5">
				<div class="switcherCase group__switchCase active" data-col="col-1"></div>
				<div class="switcherCase group__switchCase" data-col="col-2"></div>
				<div class="switcherCase group__switchCase" data-col="col-3"></div>
				<div class="switcherCase group__switchCase" data-col="col-4"></div>
			</div>
		@endif

		@if (array_key_exists('4', $users))
			<h4 class="group__tableDesc">ІНФОРМАЦІЯ ПРО КУРАТОРА</h4>
			<div class="group__table table-4">
				<div class="group__row">
					<div class="group__th group__tdID">№</div>
					<div class="group__th group__tdName">ПРІЗВИЩЕ <br> ТА ІНІЦІАЛИ</div>
					<div class="group__th col-1 visible">ДАТА <br> НАРОДЖЕННЯ</div>
					<div class="group__th col-2">МОБІЛЬНИЙ <br> ТЕЛЕФОН</div>
					<div class="group__th col-3">E-MAIL <br> АДРЕС</div>
					<div class="group__th col-4">ОТРИМУЄ <br> СТИПЕНДІЮ</div>
				</div>
				
				@foreach ($users['4'] as $user)
					@if ($permission > 3)
						<div class="group__row userRow editable" data-id="{{$user->id}}">
							<div class="group__td group__tdID">{{$loop->iteration}}</div>
							<div class="group__td group__tdName">
								@php 
									$initials = mb_substr($user->name, 0 , 1). '.' . mb_substr($user->patronymic, 0 , 1). '.';
								@endphp
								<div class="userName">{{$user->surname . ' ' . $initials}}</div>
								@if ($permission > 4)
									<div class="group__delete" data-id="{{$user->id}}"></div>
								@endif
							</div>
							<div class="group__td col-1 visible">
								@php
									$dob = new DateTime($user->dayOfBirth);
								@endphp
								<div class="group__text">{{$dob->format('d-m-Y')}}</div>
								<input type="text" class="inputText group__input userDofB">
							</div>
							<div class="group__td col-2">
								<div class="group__text">{{$user->phone}}</div>
								<input type="text" class="inputText group__input userPhone">
							</div>
							<div class="group__td col-3">
								<div class="group__text">{{$user->email}}</div>
								<input type="text" class="inputText group__input userEmail">
							</div>
							<div class="group__td col-4">
								<div class="group__text">{{$user->grant == 0 ? 'НІ' : 'ТАК'}}</div>
								<div class="group__grant">
									<div class="group__radios">
										<div class="group__radio"><input class="radioNO" type="radio" name="grant{{$user->id}}" value="0" data-val="НІ">НІ</div>
										<div class="group__radio"><input class="radioYES" type="radio" name="grant{{$user->id}}" value="1" data-val="ТАК">ТАК</div>
									</div>
								</div>
							</div>
						</div>
					@else
					<div class="group__row userRow" data-id="{{$user->id}}">
							<div class="group__td group__tdID">{{$loop->iteration}}</div>
							<div class="group__td group__tdName">
								@php 
									$initials = mb_substr($user->name, 0 , 1). '.' . mb_substr($user->patronymic, 0 , 1). '.';
								@endphp
								<div class="userName">{{$user->surname . ' ' . $initials}}</div>
							</div>
							<div class="group__td col-1 visible">
								@php
									$dob = new DateTime($user->dayOfBirth);
								@endphp
								<div class="group__text">{{$dob->format('d-m-Y')}}</div>
							</div>
							<div class="group__td col-2">
								<div class="group__text">{{$user->phone}}</div>
							</div>
							<div class="group__td col-3">
								<div class="group__text">{{$user->email}}</div>
							</div>
							<div class="group__td col-4">
								<div class="group__text">{{$user->grant == 0 ? 'НІ' : 'ТАК'}}</div>
							</div>
						</div>
					@endif

				@endforeach
			</div>
			<div class="switcher group__switch" data-table="table-4">
				<div class="switcherCase group__switchCase active" data-col="col-1"></div>
				<div class="switcherCase group__switchCase" data-col="col-2"></div>
				<div class="switcherCase group__switchCase" data-col="col-3"></div>
				<div class="switcherCase group__switchCase" data-col="col-4"></div>
			</div>
		@endif

		@if (array_key_exists('3', $users) || array_key_exists('2', $users))
			<h4 class="group__tableDesc">ІНФОРМАЦІЯ ПРО СТАРОСТУ ТА ЗАСТУПНИКА</h4>
			<div class="group__table table-23">
				<div class="group__row">
					<div class="group__th group__tdID">№</div>
					<div class="group__th group__tdName">ПРІЗВИЩЕ <br> ТА ІНІЦІАЛИ</div>
					<div class="group__th col-1 visible">ДАТА <br> НАРОДЖЕННЯ</div>
					<div class="group__th col-2">МОБІЛЬНИЙ <br> ТЕЛЕФОН</div>
					<div class="group__th col-3">E-MAIL <br> АДРЕС</div>
					<div class="group__th col-4">ОТРИМУЄ <br> СТИПЕНДІЮ</div>
				</div>
				@if (array_key_exists('3', $users))
					@foreach ($users['3'] as $user)
						@if ($permission > 3)
							<div class="group__row userRow editable" data-id="{{$user->id}}">
								<div class="group__td group__tdID">{{$loop->iteration}}</div>
								<div class="group__td group__tdName">
									@php 
										$initials = mb_substr($user->name, 0 , 1). '.' . mb_substr($user->patronymic, 0 , 1). '.';
									@endphp
									<div class="userName">{{$user->surname . ' ' . $initials}}</div>
									@if ($permission > 4)
										<div class="group__delete" data-id="{{$user->id}}"></div>
									@endif
								</div>
								<div class="group__td col-1 visible">
									@php
										$dob = new DateTime($user->dayOfBirth);
									@endphp
									<div class="group__text">{{$dob->format('d-m-Y')}}</div>
									<input type="text" class="inputText group__input userDofB">
								</div>
								<div class="group__td col-2">
									<div class="group__text">{{$user->phone}}</div>
									<input type="text" class="inputText group__input userPhone">
								</div>
								<div class="group__td col-3">
									<div class="group__text">{{$user->email}}</div>
									<input type="text" class="inputText group__input userEmail">
								</div>
								<div class="group__td col-4">
									<div class="group__text">{{$user->grant == 0 ? 'НІ' : 'ТАК'}}</div>
									<div class="group__grant">
										<div class="group__radios">
											<div class="group__radio"><input class="radioNO" type="radio" name="grant{{$user->id}}" value="0" data-val="НІ">НІ</div>
											<div class="group__radio"><input class="radioYES" type="radio" name="grant{{$user->id}}" value="1" data-val="ТАК">ТАК</div>
										</div>
									</div>
								</div>
							</div>
						@else
							<div class="group__row userRow" data-id="{{$user->id}}">
								<div class="group__td group__tdID">{{$loop->iteration}}</div>
								<div class="group__td group__tdName">
									@php 
										$initials = mb_substr($user->name, 0 , 1). '.' . mb_substr($user->patronymic, 0 , 1). '.';
									@endphp
									<div class="userName">{{$user->surname . ' ' . $initials}}</div>
								</div>
								<div class="group__td col-1 visible">
									@php
										$dob = new DateTime($user->dayOfBirth);
									@endphp
									<div class="group__text">{{$dob->format('d-m-Y')}}</div>
								</div>
								<div class="group__td col-2">
									<div class="group__text">{{$user->phone}}</div>
								</div>
								<div class="group__td col-3">
									<div class="group__text">{{$user->email}}</div>
								</div>
								<div class="group__td col-4">
									<div class="group__text">{{$user->grant == 0 ? 'НІ' : 'ТАК'}}</div>
								</div>
							</div>
						@endif

					@endforeach
				@endif
				@if (array_key_exists('2', $users))
					@foreach ($users['2'] as $user)
					@if ($permission > 3)
						<div class="group__row userRow editable" data-id="{{$user->id}}">
							<div class="group__td group__tdID">{{$loop->iteration}}</div>
							<div class="group__td group__tdName">
								@php 
									$initials = mb_substr($user->name, 0 , 1). '.' . mb_substr($user->patronymic, 0 , 1). '.';
								@endphp
								<div class="userName">{{$user->surname . ' ' . $initials}}</div>
								@if ($permission > 4)
									<div class="group__delete" data-id="{{$user->id}}"></div>
								@endif
							</div>
							<div class="group__td col-1 visible">
								@php
									$dob = new DateTime($user->dayOfBirth);
								@endphp
								<div class="group__text">{{$dob->format('d-m-Y')}}</div>
								<input type="text" class="inputText group__input userDofB">
							</div>
							<div class="group__td col-2">
								<div class="group__text">{{$user->phone}}</div>
								<input type="text" class="inputText group__input userPhone">
							</div>
							<div class="group__td col-3">
								<div class="group__text">{{$user->email}}</div>
								<input type="text" class="inputText group__input userEmail">
							</div>
							<div class="group__td col-4">
								<div class="group__text">{{$user->grant == 0 ? 'НІ' : 'ТАК'}}</div>
								<div class="group__grant">
									<div class="group__radios">
										<div class="group__radio"><input class="radioNO" type="radio" name="grant{{$user->id}}" value="0" data-val="НІ">НІ</div>
										<div class="group__radio"><input class="radioYES" type="radio" name="grant{{$user->id}}" value="1" data-val="ТАК">ТАК</div>
									</div>
								</div>
							</div>
						</div>
					@else
						<div class="group__row userRow" data-id="{{$user->id}}">
							<div class="group__td group__tdID">{{$loop->iteration}}</div>
							<div class="group__td group__tdName">
								@php 
									$initials = mb_substr($user->name, 0 , 1). '.' . mb_substr($user->patronymic, 0 , 1). '.';
								@endphp
								<div class="userName">{{$user->surname . ' ' . $initials}}</div>
							</div>
							<div class="group__td col-1 visible">
								@php
									$dob = new DateTime($user->dayOfBirth);
								@endphp
								<div class="group__text">{{$dob->format('d-m-Y')}}</div>
							</div>
							<div class="group__td col-2">
								<div class="group__text">{{$user->phone}}</div>
							</div>
							<div class="group__td col-3">
								<div class="group__text">{{$user->email}}</div>
							</div>
							<div class="group__td col-4">
								<div class="group__text">{{$user->grant == 0 ? 'НІ' : 'ТАК'}}</div>
							</div>
						</div>
					@endif

				@endforeach
				@endif
			</div>
			<div class="switcher group__switch" data-table="table-23">
				<div class="switcherCase group__switchCase active" data-col="col-1"></div>
				<div class="switcherCase group__switchCase" data-col="col-2"></div>
				<div class="switcherCase group__switchCase" data-col="col-3"></div>
				<div class="switcherCase group__switchCase" data-col="col-4"></div>
			</div>
		@endif

		@if (array_key_exists('1', $users))
			<h4 class="group__tableDesc">ІНФОРМАЦІЯ ПРО СТУДЕНТІВ</h4>
			<div class="group__table table-1">
				<div class="group__row">
					<div class="group__th group__tdID">№</div>
					<div class="group__th group__tdName">ПРІЗВИЩЕ <br> ТА ІНІЦІАЛИ</div>
					<div class="group__th col-1 visible">ДАТА <br> НАРОДЖЕННЯ</div>
					<div class="group__th col-2">МОБІЛЬНИЙ <br> ТЕЛЕФОН</div>
					<div class="group__th col-3">E-MAIL <br> АДРЕС</div>
					<div class="group__th col-4">ОТРИМУЄ <br> СТИПЕНДІЮ</div>
				</div>
				
				@foreach ($users['1'] as $user)
					@if ($permission > 3)
						<div class="group__row userRow editable" data-id="{{$user->id}}">
							<div class="group__td group__tdID">{{$loop->iteration}}</div>
							<div class="group__td group__tdName">
								@php 
									$initials = mb_substr($user->name, 0 , 1). '.' . mb_substr($user->patronymic, 0 , 1). '.';
								@endphp
								<div class="userName">{{$user->surname . ' ' . $initials}}</div>
								@if ($permission > 4)
									<div class="group__delete" data-id="{{$user->id}}"></div>
								@endif
							</div>
							<div class="group__td col-1 visible">
								@php
									$dob = new DateTime($user->dayOfBirth);
								@endphp
								<div class="group__text">{{$dob->format('d-m-Y')}}</div>
								<input type="text" class="inputText group__input userDofB">
							</div>
							<div class="group__td col-2">
								<div class="group__text">{{$user->phone}}</div>
								<input type="text" class="inputText group__input userPhone">
							</div>
							<div class="group__td col-3">
								<div class="group__text">{{$user->email}}</div>
								<input type="text" class="inputText group__input userEmail">
							</div>
							<div class="group__td col-4">
								<div class="group__text">{{$user->grant == 0 ? 'НІ' : 'ТАК'}}</div>
								<div class="group__grant">
									<div class="group__radios">
										<div class="group__radio"><input class="radioNO" type="radio" name="grant{{$user->id}}" value="0" data-val="НІ">НІ</div>
										<div class="group__radio"><input class="radioYES" type="radio" name="grant{{$user->id}}" value="1" data-val="ТАК">ТАК</div>
									</div>
								</div>
							</div>
						</div>
					@else
						<div class="group__row userRow" data-id="{{$user->id}}">
							<div class="group__td group__tdID">{{$loop->iteration}}</div>
							<div class="group__td group__tdName">
								@php 
									$initials = mb_substr($user->name, 0 , 1). '.' . mb_substr($user->patronymic, 0 , 1). '.';
								@endphp
								<div class="userName">{{$user->surname . ' ' . $initials}}</div>
							</div>
							<div class="group__td col-1 visible">
								@php
									$dob = new DateTime($user->dayOfBirth);
								@endphp
								<div class="group__text">{{$dob->format('d-m-Y')}}</div>
							</div>
							<div class="group__td col-2">
								<div class="group__text">{{$user->phone}}</div>
							</div>
							<div class="group__td col-3">
								<div class="group__text">{{$user->email}}</div>
							</div>
							<div class="group__td col-4">
								<div class="group__text">{{$user->grant == 0 ? 'НІ' : 'ТАК'}}</div>
							</div>
						</div>
					@endif
				@endforeach

			</div>
			<div class="switcher group__switch" data-table="table-1">
				<div class="switcherCase group__switchCase active" data-col="col-1"></div>
				<div class="switcherCase group__switchCase" data-col="col-2"></div>
				<div class="switcherCase group__switchCase" data-col="col-3"></div>
				<div class="switcherCase group__switchCase" data-col="col-4"></div>
			</div>
		@endif

		@if ($permission > 3)
			<div class="controlBlock group__edit">
				@if ($permission > 4)
					<button class="group__editButton button-cancel group__removeGroup">ВИДАЛИТИ ГРУПУ</button>
					<button class="group__editButton button-cancel group__changeGrName">ЗМІНИТИ ШИФР</button>
				@endif
				<button class="group__editButton button-cancel group__editEdit button-edit">РЕДАГУВАТИ ДАНІ</button>
				<button class="group__editButton button-cancel group__editCancel button-nosave">ВІДМІНИТИ ЗМІНИ</button>
				<button class="group__editButton button-ok group__editSubmit button-save">ЗБЕРЕГТИ ЗМІНИ</button>
			</div>
		@endif

		@if ($permission > 4)
			<div id="overlay" class="overlay">
				<div class="container">
					<div class="modal modalRemoveUser">
						<div class="modal__header">ВИДАЛЕННЯ ОСОБИ</div>
						<div class="modal__text">
							Ви справді хочете видалити <span class="userName"></span> з групи?
						</div>
						<div class="modal__buttons">
							<button class="button modal__button button-cancel">НІ</button>
							<button class="button modal__button button-ok btnRemoveUser">ВИДАЛИТИ</button>
						</div>
					</div>

					<div class="modal modalRemoveGroup">
						<div class="modal__header">ВИДАЛЕННЯ ГРУПИ</div>
						<div class="modal__text">
							Ви справді хочете видалити безповоротно дану групу?
						</div>
						<div class="modal__buttons">
							<button class="button modal__button button-cancel">НІ</button>
							<button class="button modal__button button-ok btnRemoveGroup" data-id="{{$groupID}}">ВИДАЛИТИ</button>
						</div>
					</div>

					<div class="modal modalChangeGrName">
						<div class="modal__header">ЗМІНА ШИФРУ ГРУПИ</div>
						<div class="modal__text">
							Напишіть новий шифр групи:
						</div>
						<input type="text" name="newGrName" class="modal__newGrName">
						<div class="modal__buttons">
							<button class="button modal__button button-cancel">НІ</button>
							<button class="button modal__button button-ok btnChangeGrName" data-id="{{$groupID}}">ЗМІНИТИ</button>
						</div>
					</div>
				</div>
			</div>
		@endif

		<script src="{{ URL::asset('js/group.min.js') }}"></script>
	@endif
@endif