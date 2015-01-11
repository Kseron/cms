 
(function ($, undefined) {

	$.widget('ui.carousel', {
	
		version: '0.6.1',
		
		// holds original class string
		oldClass: null,
		
		options: {
			glimsPerPage: 'auto',
			glimsPerTransition: 'auto',
			orientation: 'horizontal',
			noOfRows: 1, // horizontal only
			unknownHeight: true, // horizontal only (allows unknown glim height - useful if, for example, glims contains textual content)
			pagination: true,
			insertPagination: null,
			nextPrevActions: true,
			insertNextAction: null,
			insertPrevAction: null,
			speed: 'normal',
			easing: 'swing',
			startAt: null,
			beforeAnimate: null,
			afterAnimate: null
		},
		
		_create: function () {
		
			this.pageIndex = 1;
			
			this._elements();
			this._addClasses();
			this._defineOrientation();
			this._addMask();
			this._setMaskDim();
			this._setglimDim();
			this._setglimsPerPage();
			this._setNoOfglims();
			this._setNoOfPages();
			this._setRunnerWidth();
			this._setMaskHeight();
			this._setLastPos();
			this._addPagination();
			this._addNextPrevActions();
			
			if (this.options.startAt) {
				this.goToPage(this.options.startAt, false);
			}
			
			this._updateUi();
			
		},
		
		// caches DOM elements
		_elements: function () {
		
			var elems = this.elements = {};
			
			elems.mask = this.element.find('.mask');
			elems.runner = this.element.find('ul');
			elems.glims = elems.runner.children('li');
			elems.pagination = null;
			elems.nextAction = null;
			elems.prevAction = null;
		
		},
		
		_addClasses: function () {
		
			if (!this.oldClass) {
				this.oldClass = this.element.attr('class');
			}
		
			this._removeClasses();
			
			var baseClass = this.widgetBaseClass,
				classes = [];
				
			classes.push(baseClass);
			classes.push(baseClass + '-' + this.options.orientation);
			classes.push(baseClass + '-glims-' + this.options.glimsPerPage);
			classes.push(baseClass + '-rows-' + this.options.noOfRows);
		
			this.element.addClass(classes.join(' '));
		
		},
		
		// removes ui-carousel* classes
		_removeClasses: function () {
		
			var uiClasses = [],
				current,
				fragments;
		
			this.element.removeClass(function (i, currentClasses) {
				
				currentClasses = currentClasses.split(' ');
				
				$.each(currentClasses, function (i) {
					
					current = currentClasses[i];
					fragments = current.split('-');
					
					if (fragments[0] === 'ui' && fragments[1] === 'carousel') {
						uiClasses.push(current);
					}
					
				});
				
				return uiClasses.join(' ');
				
			});
		
		},
		
		// defines obj to hold strings based on orientation for dynamic method calls
		_defineOrientation: function () {

			if (this.options.orientation === 'horizontal') {
				this.horizontal = true;
				this.helperStr = {
					pos: 'left',
					pos2: 'right',
					dim: 'width'
				};
			}
			else {
				this.horizontal = false;
				this.helperStr = {
					pos: 'top',
					pos2: 'bottom',
					dim: 'height'
				};	
				this.options.noOfRows = 1;
			}
		
		},
		
		// adds masking div (aka clipper)
		_addMask: function () {
		
			var elems = this.elements;
			
			if (elems.mask.length) {
				return;
			}
			
			elems.mask = elems.runner
				.wrap('<div class="mask" />')
				.parent();
			
			// indicates whether mask was dynamically added or already existed in mark-up
			this.maskAdded = true;
			
		},
		
		// sets maskDim to later detemine lastPos
		_setMaskDim: function () {
		
			this.maskDim = this.elements.mask[this.helperStr.dim]();
		
		},
		
		// sets masks height allowing glims to have an unknown height (not applicable to vertical orientation)
		_setMaskHeight: function () {
		
			if (!this.horizontal || !this.options.unknownHeight) {
				return;
			}
			
			var elems = this.elements,
				maskHeight = elems.runner.outerHeight(true);
			
			elems.mask.height(maskHeight);
			
		},
		
		// sets glimDim to the dimension of first glim incl. margin
		_setglimDim: function () {
			
			// is this ridiculous??
			this.glimDim = this.elements.glims['outer' + this.helperStr.dim.charAt(0).toUpperCase() + this.helperStr.dim.slice(1)](true);
			
		},
		
		// sets options.glimsPerPage based on maskdim
		_setglimsPerPage: function () {
			
			// if glimsPerPage of type number don't dynamically calculate
			if (typeof this.options.glimsPerPage === 'number') {
				// don't directly use options.glimsPerPage as reference to 'auto' needs to be kept if not number
				this.glimsPerPage = this.options.glimsPerPage;
			}
			else {
				this.glimsPerPage = Math.floor(this.maskDim / this.glimDim);
			}
			
		},
		
		// sets no of glims, not neccesarily the literal number of glims if more than one row
		_setNoOfglims: function () {

			this.noOfglims = Math.ceil(this.elements.glims.length / this.options.noOfRows);
			
			// fixed 9 glims, 3 rows, 4 shown 
			if (this.noOfglims < this.glimsPerPage) {
				this.noOfglims = this.glimsPerPage;
			}
			
		},
		
		// sets noOfPages
		_setNoOfPages: function () {
		
			this.noOfPages = Math.ceil((this.noOfglims - this.glimsPerPage) / this._getglimsPerTransition()) + 1;
		
		},
		
		_getglimsPerTransition: function () {
		    
		    if (this.options.glimsPerTransition === 'auto') {
		        return this.glimsPerPage;
		    }
		    
		    return this.options.glimsPerTransition;
		},
		
		// sets runners width
		_setRunnerWidth: function () {
		
			if (!this.horizontal) {
				return;
			}
			
			var width = this.glimDim * this.noOfglims;
			this.elements.runner.width(width);
			
		},
		
		// sets lastPos to ensure runner doesn't move beyond mask (allowing mask to be any width and the use of margins)
		_setLastPos: function () {
			
			// noOfrows means last theoretical glim might not be the last glim
			var lastglim = this.elements.glims.eq(this.noOfglims - 1);
			
			this.lastPos = lastglim.position()[this.helperStr.pos] + this.glimDim -
				this.maskDim - parseInt(lastglim.css('margin-' + this.helperStr.pos2), 10);
				
		},
		
		// adds pagination links and binds associated events
		_addPagination: function () {
		
			if (!this.options.pagination) {
				return;
			}
		
			var self = this,
				elems = this.elements,
				opts = this.options,
				links = [],
				i;
			
			for (i = 1; i <= this.noOfPages; i++) {
				links[i] = '<li><a href="#glim-' + i + '">' + i + '</a></li>';
			}
			
			elems.pagination = $('<ol class="pagination-links" />')
				.append(links.join(''))
				.delegate('a', 'click.carousel', function () {
					
					self.goToPage(parseInt(this.hash.split('-')[1], 10));
					
					return false;
					
				});
				
			if ($.isFunction(opts.insertPagination)) {
				$.proxy(opts.insertPagination, elems.pagination)();
			}
			else {
				elems.pagination.insertAfter(elems.mask);
			}
				
		},
		
		// refreshes pagination links
		_refreshPagination: function () {
			
			if (!this.options.pagination) {
				return;
			}
			
			this.elements.pagination.remove();
			this._setNoOfPages();
			this._addPagination();
			
		},
		
		// shows specific page (one based)
		goToPage: function (pageIndex, animate) {
		
			this.pageIndex = pageIndex;
			
			this._go(animate);
			
		},
		
		// shows specific glim (one based)
		goToglim: function(glimIndex, animate) {
			
			if (typeof glimIndex !== 'number') { // assume element or jQuery obj
				glimIndex = $(glimIndex).index() + 1; // make one based
			}
			
			// perhaps a little inefficient to be converting glim index to page index
			// as _go() coverts back to glim index...
			this.pageIndex = Math.ceil(glimIndex / this._getglimsPerTransition());
			
			this._go(animate);
			
		},
		
		// adds next and prev links
		_addNextPrevActions: function () {
		
			if (!this.options.nextPrevActions) {
				return;
			}
		
			var self = this,
				elems = this.elements,
				opts = this.options;
				
			elems.prevAction = $('<a href="#" class="prev">Prev</a>')
				.bind('click.carousel', function () {
					self.prev();
					return false;
				});
				
			if ($.isFunction(opts.insertPrevAction)) {
				$.proxy(opts.insertPrevAction, elems.prevAction)();
			}
			else {
				elems.prevAction.appendTo(this.element);
			}
			
			elems.nextAction = $('<a href="#" class="next">Next</a>')
				.bind('click.carousel', function () {
					self.next();
					return false;
				});
				
			if ($.isFunction(opts.insertNextAction)) {
				$.proxy(opts.insertNextAction, elems.nextAction)();
			}
			else {
				elems.nextAction.appendTo(this.element);
			}
			
		},
		
		// moves to next page
		next: function () {
		
			this.pageIndex += 1;
			this._go();
			
		},
		
		// moves to prev page
		prev: function () {
		
			this.pageIndex -= 1;
			this._go();
			
		},
		
		// updates pagination, next and prev link status classes (NOTE: refactor this)
		_updateUi: function () {
		
			var elems = this.elements,
				index = this.pageIndex,
				
				// add void class if ui doesn't make sense - can then be either hidden or styled like disabled / current
				// better than setting pagination to false as this senario isn't an 'option change'
				isVoid = this.noOfglims <= this.glimsPerPage;
		
			if (this.options.pagination) {
			
				if (isVoid) {
					elems.pagination.addClass('void');
				}
				else {
					elems.pagination
						.children('li')
							.removeClass('current')
							.filter(':nth-child(' + index + ')')
								.addClass('current');
				}
				
			}

			if (this.options.nextPrevActions) {
			
				var nextPrev = elems.nextAction.add(elems.prevAction);
				nextPrev.removeClass('disabled');
				
				if (isVoid) {
					nextPrev.addClass('void');
				}
				else {
					nextPrev.removeClass('void');
					
					if (index === this.noOfPages) {
						elems.nextAction.addClass('disabled');
					}
					else if (index === 1) {
						elems.prevAction.addClass('disabled');
					}
				}
			}
			
		},
		
		// validates glimIndex and slides
		_go: function (animate, callback) {
		
			var self = this,
				elems = this.elements,
				speed = animate === false ? 0 : this.options.speed, // default to animate
				animateProps = {},
				glimIndex,
				pos;
			
			// validate pageIndex
			if (this.pageIndex < 1) { this.pageIndex = 1; }
			
			if (this.pageIndex > this.noOfPages) { this.pageIndex = this.noOfPages; }
				
			// get glim to animate to based on page
			glimIndex = (this.pageIndex - 1) * this._getglimsPerTransition();
			
			pos = glimIndex * this.glimDim;
			
			// check pos doesn't go past last
			if (pos > this.lastPos) {
				pos = this.lastPos;
			}
			
			animateProps[this.helperStr.pos] = -pos;
			
			this._trigger('beforeAnimate', null, {
				page: this.pageIndex
			});
			
			/* CSS transitions perform very poorly
			elems.runner.css({
				left: -pos,
				transition: 'left .3s linear',
				'-o-transition': 'left .400s linear',
				'-moz-transition': 'left .400s linear',
				'-webkit-transition': 'left .400s linear',
				'-webkit-transition': 'left .400s linear',
				'-moz-transition': 'left .400s linear'
			});*/
		
			elems.runner
				.stop()
				.animate(animateProps, speed, this.options.easing, function() {
					
					self._trigger('afterAnimate', null, {
						page: self.pageIndex
					});
					
					if ($.isFunction(callback)) {
						callback();
					}
					
				});
			
			this._updateUi();
		},
		
		// refresh carousel
		_refresh: function () {
			
			this.pageIndex = 1;
			
			this.elements.runner.css({
				left: '',
				top: ''
			});
			this._addClasses();
			this._setMaskDim();
			this._setglimDim();
			this._setglimsPerPage();
			this._setNoOfglims();
			this._setRunnerWidth();
			this._setMaskHeight();
			this._setLastPos();
			this._refreshPagination();
			this._updateUi();
			
		},
		
		// adds glims to end and refreshes carousel, glims === jquery obj
		addglims: function (glims) {
		
			var elems = this.elements;
		
			glims.appendTo(elems.runner);
			elems.glims = elems.runner.children('li');
			this._refresh();
		
		},
		
		// handles option updates
		_setOption: function (option, value) {
			
			var elems = this.elements,
				opts = this.options;
				
			$.Widget.prototype._setOption.apply(this, arguments);
			
			switch (option) {
				
			case 'glimsPerPage':
				
				this._refresh();
				
				break;
				
			case 'glimsPerTransition':
				
				this._refresh();
				
				break;
				
			case 'noOfRows':
				
				if (this.horizontal) {
					this._refresh();
				}
				else {
					// noOfRows must be 1 if vertical
					opts.noOfRows = 1;
				}
				
				break;
				
			case 'unknownHeight':
				
				if (value) {
					this._setMaskHeight();
				}
				else {
					elems.mask.height('');
				}
				
				break;
				
			case 'orientation':
						
				this._defineOrientation();
				elems.mask.height('');
				elems.runner.width('');
				this._refresh();
				
				break;
					
			case 'pagination':
				
				if (value && !elems.pagination) {
					this._addPagination();
					this._updateUi();
				}
				else if (!value && elems.pagination) {
					elems.pagination.remove();
					elems.pagination = null;
				}
				
				break;
				
			case 'nextPrevActions':

				if (value && !elems.nextAction) {
					this._addNextPrevActions();
					this._updateUi();
				}
				else if (!value && elems.nextAction) {
					elems.nextAction.remove();
					elems.nextAction = null;
					elems.prevAction.remove();
					elems.prevAction = null;
				}
				
				break;
					
			}
		
		},
		
		// returns carousel to original state
		destroy: function () {
		
			var elems = this.elements,
				cssProps = {};
				
			this.element.removeClass().addClass(this.oldClass);
		
			if ('maskAdded' in this) {
				elems.runner
					.unwrap('.mask');
			}
			else {
				elems.mask.height('');
			}
			
			// should really store original value?
			cssProps[this.helperStr.pos] = '';
			cssProps[this.helperStr.dim] = '';
			elems.runner.css(cssProps);
			
			if (elems.pagination) {
				elems.pagination.remove();
			}
			
			if (elems.nextAction) {
				elems.nextAction.remove();
				elems.prevAction.remove();
			}
			
			// overkill?
			$.each(elems, function () {
				$(this).unbind('.carousel');
			});
			
			$.Widget.prototype.destroy.apply(this, arguments);
			
		}
		
	});
	
})(jQuery);