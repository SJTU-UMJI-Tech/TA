(function (factory)
{
	if (typeof define === 'function' && define.amd)
	{
		// AMD. Register as anonymous module.
		define(['jquery'], factory);
	}
	else if (typeof exports === 'object')
	{
		// Node / CommonJS
		factory(require('jquery'));
	}
	else
	{
		// Browser globals.
		factory(jQuery);
	}
})(function ($)
{
	'use strict';
	
	function AppForm($element)
	{
		this.$container = $element;
		this.$autosave = this.$container.find(".form-autosave");
		
		this.$basic = this.$container.find(".form-basic");
		
		this.$edu = this.$container.find(".form-education");
		this.$eduInfo = this.$edu.find(".form-info");
		this.$eduBtnAdd = this.$edu.find(".btn-add");
		
		this.$exp = this.$container.find(".form-ta-experience");
		this.$expInfo = this.$exp.find(".form-info");
		
		this.$work = this.$container.find(".form-work-experience");
		this.$workInfo = this.$work.find(".form-info");
		this.$workBtnAdd = this.$work.find(".btn-add");
		
		this.$res = this.$container.find(".form-research");
		
		this.$lang = this.$container.find(".form-language");
		this.$langInfo = this.$lang.find(".form-info");
		this.$langBtnAdd = this.$lang.find(".btn-add");
		
		this.$com = this.$container.find(".form-computer");
		this.$awd = this.$container.find(".form-award");
		
		this.$ref = this.$container.find(".form-reference");
		this.$refInfo = this.$ref.find(".form-info");
		this.$refBtnAdd = this.$ref.find(".btn-add");
		
		this.init();
	}
	
	AppForm.prototype = {
		
		constructor: AppForm,
		
		init: function ()
		{
			this.addListener();
			this.addEdu();
			this.addWork();
			this.addLang();
			this.addRef();
		},
		
		initInfo: function (name, birthday, id, class_id, course)
		{
			this.$basic.find("input[name='chinese-name']").val(name);
			this.$basic.find("input[name='birth-date']").val(birthday);
			this.$edu.find("input[name='student-id']").val(id);
			this.$edu.find("input[name='class-id']").val(class_id);
			for (var index in course)
			{
				this.addExp({
					code: course[index].KCDM,
					name: course[index].KCZWMC,
					period: course[index].XQ_JI + " " + course[index].XN.substr(0, 4),
					instructor: course[index].XM
				});
			}
		},
		
		initHistory: function (name_en, gender, phone, email, skype, address)
		{
			this.$basic.find("input[name='english-name']").val(name_en);
			this.$basic.find("input[name='phone']").val(phone);
			this.$basic.find("input[name='email']").val(email);
			this.$basic.find("input[name='skype']").val(skype);
			this.$basic.find("input[name='address']").val(address);
			this.$basic.find("input[name='gender']").each(function ()
			{
				if ($(this).val() == 'male' && gender == 'M' || $(this).val() == 'female' && gender == 'F')
				{
					$(this).attr('checked', 'checked');
				}
			});
		},
		
		addListener: function ()
		{
			this.$eduBtnAdd.on('click', $.proxy(this.onClickAddEdu, this));
			this.$workBtnAdd.on('click', $.proxy(this.onClickAddWork, this));
			this.$langBtnAdd.on('click', $.proxy(this.onClickAddLang, this));
			this.$refBtnAdd.on('click', $.proxy(this.onClickAddRef, this));
		},
		
		onClickAddEdu: function ()
		{
			this.addEdu();
		},
		
		onClickAddWork: function ()
		{
			this.addWork();
		},
		
		onClickAddLang: function ()
		{
			this.addLang();
		},
		
		onClickAddRef: function ()
		{
			this.addRef();
		},
		
		onClickDel: function (e)
		{
			var $target = $(e.target).parents(".form-row").first();
			var $list = $target.parents(".form-list").first();
			$target.remove();
			var count = 1;
			$list.find(".form-row").each(function ()
			{
				$(this).find(".form-row-id").html(count++);
			});
		},
		
		addEdu: function (item)
		{
			var width = [2, 2, 2, 2, 2];
			var order = ['level', 'school', 'period', 'institute', 'major'];
			return this.generate(this.$eduInfo, width, order, item);
		},
		
		
		addExp: function (item)
		{
			var id = this.$expInfo.find(".form-row").length + 1;
			var width = [2, 4, 2, 3];
			var order = ['code', 'name', 'period', 'instructor'];
			var html = '<div class="row form-row">' +
			           '<h5 class="col-sm-1 form-row-id">' + id + '</h5>';
			for (var index in width)
			{
				html += '<div class="col-sm-' + width[index] + '">' +
				        '<input class="form-control text-center" type="text" title="list" value="' +
				        (item[order[index]] ? item[order[index]] : '') +
				        '" disabled="disabled" name="' + order[index] + '">' +
				        '</div>';
			}
			html += '</div>';
			this.$expInfo.append(html);
		},
		
		addWork: function (item)
		{
			var id = this.$workInfo.find(".form-row").length + 1;
			var width = [4, 4, 2];
			var order = ['position', 'institution', 'period', 'description'];
			var html = '<div class="form-row">' +
			           '<div class="row">' +
			           '<h5 class="col-sm-1 form-row-id">' + id + '</h5>';
			for (var index in width)
			{
				html += '<div class="col-sm-' + width[index] + '">' +
				        '<h5>' + order[index] + '</h5>' +
				        '</div>';
			}
			html += '</div>' +
			        '<div class="row">' +
			        '<h5 class="col-sm-1"></h5>';
			for (index in width)
			{
				html += '<div class="col-sm-' + width[index] + '">' +
				        '<input class="form-control" type="text" title="list" value="' +
				        (item ? (item[order[index]] ? item[order[index]] : '') : '') +
				        '" name="' + order[index] + '">' +
				        '</div>';
			}
			if (id > 1)
			{
				html += '<div class="col-sm-1">' +
				        '<button class="btn btn-danger btn-del">' +
				        '<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>' +
				        '</button>' +
				        '</div>';
			}
			html += '</div>' +
			        '<h4>Brief Job Description: </h4>' +
			        '<textarea rows="10" style="resize:none; width:100%" name="description" title="list"></textarea>' +
			        '</div>';
			this.$workInfo.append(html);
			return this.addBtnDelListener(this.$workInfo);
		},
		
		addLang: function (item)
		{
			var width = [2, 2, 2, 2, 2];
			var order = ['type', 'listening', 'speaking', 'reading', 'writing'];
			return this.generate(this.$langInfo, width, order, item);
		},
		
		addRef: function (item)
		{
			var width = [1, 2, 2, 2, 3];
			var order = ['name', 'institution', 'position', 'phone', 'email'];
			return this.generate(this.$refInfo, width, order, item);
		},
		
		/**
		 * @param {Object} $info
		 * @param {Array} width
		 * @param {Array} order
		 * @param {Array} item
		 */
		generate: function ($info, width, order, item)
		{
			var id = $info.find(".form-row").length + 1;
			var html = '<div class="row form-row">' +
			           '<h5 class="col-sm-1 form-row-id">' + id + '</h5>';
			for (var index in width)
			{
				html += '<div class="col-sm-' + width[index] + '">' +
				        '<input class="form-control" type="text" title="list" value="' +
				        (item ? (item[order[index]] ? item[order[index]] : '') : '') +
				        '" name="' + order[index] + '">' +
				        '</div>';
			}
			if (id > 1)
			{
				html += '<div class="col-sm-1">' +
				        '<button class="btn btn-danger btn-del">' +
				        '<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>' +
				        '</button>' +
				        '</div>';
			}
			html += '</div>';
			$info.append(html);
			return this.addBtnDelListener($info);
		},
		
		addBtnDelListener: function ($info)
		{
			var newRow = $info.find(".form-row").last();
			newRow.find(".btn-del").one('click', $.proxy(this.onClickDel, this));
			return newRow;
		},
		
		serialize: function ()
		{
			var data =
			{
				basic: $.extend({}, this.serializeText(this.$basic, true), this.serializeRadio(this.$basic)),
				edu: $.extend({}, this.serializeRadio(this.$edu), this.serializeList(this.$eduInfo)),
				exp: $.extend({}, this.serializeRadio(this.$exp), this.serializeText(this.$exp, true)),
				work: this.serializeList(this.$workInfo),
				res: this.serializeText(this.$res),
				lang: this.serializeList(this.$langInfo),
				com: this.serializeText(this.$com),
				awd: this.serializeText(this.$awd),
				ref: this.serializeList(this.$refInfo),
				date: (new Date()).getTime()
			};
			//console.log(data);
			return data;
		},
		
		serializeText: function ($list, flag)
		{
			var data = {};
			$list.find("textarea,input[type='text']").each(function ()
			{
				if (!flag || $(this).attr('title') != 'list')
				{
					data[$(this).attr('name')] = $(this).val();
				}
			});
			return data;
		},
		
		serializeRadio: function ($list)
		{
			var data = {};
			$list.find("input[type='radio']:checked").each(function ()
			{
				data[$(this).attr('name')] = $(this).val();
			});
			return data;
		},
		
		serializeList: function ($info)
		{
			var data = {};
			var _this = this;
			data.info = [];
			$info.find(".form-row").each(function ()
			{
				data.info.push(_this.serializeText($(this), false));
			});
			return data;
		},
		
		reform: function (id)
		{
			var data = this.loadCookie(id);
			this.reformPart(this.$basic, data.basic);
			this.reformPart(this.$edu, data.edu);
			this.reformInfo(this.$eduInfo, data.edu.info);
			this.reformPart(this.$exp, data.exp);
			this.reformInfo(this.$workInfo, data.work.info);
			this.reformPart(this.$res, data.res);
			this.reformInfo(this.$langInfo, data.lang.info);
			this.reformPart(this.$com, data.com);
			this.reformPart(this.$awd, data.awd);
			this.reformInfo(this.$refInfo, data.ref.info);
			var date = new Date(data.date + 3600000 * 8);
			this.$autosave.html('<h4>Loaded saved data at ' + date.toUTCString() + '</h4>');
		},
		
		reformPart: function ($part, data)
		{
			var property;
			for (property in data)
			{
				if (data[property] != '')
				{
					$part.find("[name='" + property + "']").each(function ()
					{
						if ($(this).attr('type') == 'radio')
						{
							$(this).removeAttr('checked');
							if ($(this).val() == data[property])
							{
								$(this).attr('checked', 'checked');
							}
						}
						else
						{
							
							$(this).val(data[property]);
							
						}
					});
				}
			}
		},
		
		reformInfo: function ($info, data)
		{
			$info.html('');
			for (var index = 0; index < data.length; index++)
			{
				switch ($info)
				{
				case this.$eduInfo:
					this.addEdu(data[index]);
					break;
				case this.$workInfo:
					this.addWork(data[index]);
					break;
				case this.$langInfo:
					this.addLang(data[index]);
					break;
				case this.$refInfo:
					this.addRef(data[index]);
					break;
				}
			}
		},
		
		saveCookie: function (id)
		{
			$.cookie('form-backup-' + id, JSON.stringify(this.serialize()), {expires: 365});
		},
		
		loadCookie: function (id)
		{
			var data = $.cookie('form-backup-' + id);
			return data ? JSON.parse(data) : {};
		},
		
		autosave: function (id, time)
		{
			var _this = this;
			setInterval(function ()
			{
				_this.saveCookie(id);
				var date = new Date((new Date()).getTime() + 3600000 * 8);
				_this.$autosave.html('<h4>Autosaved at ' + date.toUTCString() + '</h4>');
			}, time);
		}
		
	};
	
	$.fn.AppForm = function ()
	{
		return new AppForm(this);
	};
	
});