<?php
    /**
     * Loads a calendar for the user based on upcoming reminders
     * The main functionality was taken from https://www.sliderrevolution.com/resources/html-calendar/
     * It was then somewhat rewritten for our purposes of using it to show reminders and such for dogs
     */
    require_once "config/constants.php";
    enforce_login(); // Redirect to login page if not logged in.
    if(isset($reminders)) {
?>

        <div id="calendar"></div>
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
        <script src="//blueimp.github.io/JavaScript-MD5/js/md5.js"></script>
        <script>
            !function() {

                let today = moment();

                function Calendar(selector, events) {
                    this.el = document.querySelector(selector);
                    this.events = events;
                    this.current = moment().date(1);
                    this.draw();
                    let current = document.querySelector('.today');
                    if(current) {
                        let self = this;
                        window.setTimeout(function() {
                            self.openDay(current);
                        }, 500);
                    }
                }

                Calendar.prototype.draw = function() {
                    //Create Header
                    this.drawHeader();

                    //Draw Month
                    this.drawMonth();

                    this.drawLegend();
                }

                Calendar.prototype.drawHeader = function() {
                    let self = this;
                    if(!this.header) {
                        //Create the header elements
                        this.header = createElement('div', 'header');
                        this.header.className = 'header';

                        this.title = createElement('h1');

                        let right = createElement('div', 'right');
                        right.addEventListener('click', function() { self.nextMonth(); });

                        let left = createElement('div', 'left');
                        left.addEventListener('click', function() { self.prevMonth(); });

                        //Append the Elements
                        this.header.appendChild(this.title);
                        this.header.appendChild(right);
                        this.header.appendChild(left);
                        this.el.appendChild(this.header);
                    }

                    this.title.innerHTML = this.current.format('MMMM YYYY');
                }

                Calendar.prototype.drawMonth = function() {
                    let self = this;

                    this.events.forEach(function(ev) {
                        ev.date = moment(new Date(ev.date));
                    });


                    if(this.month) {
                        this.oldMonth = this.month;
                        this.oldMonth.className = 'month out ' + (self.next ? 'next' : 'prev');
                        this.oldMonth.addEventListener('webkitAnimationEnd', function() {
                            self.oldMonth.parentNode.removeChild(self.oldMonth);
                            self.month = createElement('div', 'month');
                            self.backFill();
                            self.currentMonth();
                            self.fowardFill();
                            self.el.appendChild(self.month);
                            window.setTimeout(function() {
                                self.month.className = 'month in ' + (self.next ? 'next' : 'prev');
                            }, 16);
                        });
                    } else {
                        this.month = createElement('div', 'month');
                        this.el.appendChild(this.month);
                        this.backFill();
                        this.currentMonth();
                        this.fowardFill();
                        this.month.className = 'month new';
                    }
                }

                Calendar.prototype.backFill = function() {
                    let clone = this.current.clone();
                    let dayOfWeek = clone.day();

                    if(!dayOfWeek) { return; }

                    clone.subtract('days', dayOfWeek+1);

                    for(let i = dayOfWeek; i > 0 ; i--) {
                        this.drawDay(clone.add('days', 1));
                    }
                }

                Calendar.prototype.fowardFill = function() {
                    let clone = this.current.clone().add('months', 1).subtract('days', 1);
                    let dayOfWeek = clone.day();

                    if(dayOfWeek === 6) { return; }

                    for(let i = dayOfWeek; i < 6 ; i++) {
                        this.drawDay(clone.add('days', 1));
                    }
                }

                Calendar.prototype.currentMonth = function() {
                    let clone = this.current.clone();

                    while(clone.month() === this.current.month()) {
                        this.drawDay(clone);
                        clone.add('days', 1);
                    }
                }

                Calendar.prototype.getWeek = function(day) {
                    if(!this.week || day.day() === 0) {
                        this.week = createElement('div', 'week');
                        this.month.appendChild(this.week);
                    }
                }

                Calendar.prototype.drawDay = function(day) {
                    let self = this;
                    this.getWeek(day);

                    //Outer Day
                    let outer = createElement('div', this.getDayClass(day));

                    if (day.month() < this.current.month()) {
                        outer.addEventListener('click', function() {
                            self.prevMonth();
                        });
                    } else if (day.month() > this.current.month()) {
                        outer.addEventListener('click', function() {
                            self.nextMonth();
                        });
                    } else {
                        outer.addEventListener('click', function() {
                            self.openDay(this);
                        });
                    }

                    //Day Name
                    let name = createElement('div', 'day-name', day.format('ddd'));

                    //Day Number
                    let number = createElement('div', 'day-number', day.format('DD'));

                    //Events
                    let events = createElement('div', 'day-events');
                    this.drawEvents(day, events);

                    outer.appendChild(name);
                    outer.appendChild(number);
                    outer.appendChild(events);
                    this.week.appendChild(outer);
                }

                Calendar.prototype.drawEvents = function(day, element) {
                    if(day.month() === this.current.month() || true) {
                        let todaysEvents = this.events.reduce(function(memo, ev) {
                            if(ev.date.isSame(day, 'day')) {
                                memo.push(ev);
                            }
                            return memo;
                        }, []);

                        todaysEvents.forEach(function(ev) {
                            let evSpan = createElement('span');
                            evSpan.style = 'background:'+ ev.color;
                            element.appendChild(evSpan);
                        });
                    }
                }

                Calendar.prototype.getDayClass = function(day) {
                    classes = ['day'];
                    if(day.month() !== this.current.month()) {
                        classes.push('other');
                    } else if (today.isSame(day, 'day')) {
                        classes.push('today');
                    }
                    return classes.join(' ');
                }

                Calendar.prototype.openDay = function(el) {
                    let details, arrow;
                    let dayNumber = +el.querySelectorAll('.day-number')[0].innerText || +el.querySelectorAll('.day-number')[0].textContent;
                    let day = this.current.clone().date(dayNumber);

                    let currentOpened = document.querySelector('.details');

                    //Check to see if there is an open details box on the current row
                    if(currentOpened && currentOpened.parentNode === el.parentNode) {
                        details = currentOpened;
                        arrow = document.querySelector('.arrow');
                    } else {
                        //Close the open events on different week row
                        if(currentOpened) {
                            currentOpened.addEventListener('webkitAnimationEnd', function() {
                                currentOpened.parentNode.removeChild(currentOpened);
                            });
                            currentOpened.addEventListener('oanimationend', function() {
                                currentOpened.parentNode.removeChild(currentOpened);
                            });
                            currentOpened.addEventListener('msAnimationEnd', function() {
                                currentOpened.parentNode.removeChild(currentOpened);
                            });
                            currentOpened.addEventListener('animationend', function() {
                                currentOpened.parentNode.removeChild(currentOpened);
                            });
                            currentOpened.className = 'details out';
                        }

                        //Create the Details Container
                        details = createElement('div', 'details in');

                        //Create the arrow
                        arrow = createElement('div', 'arrow');

                        //Create the event wrapper
                        details.appendChild(arrow);
                        el.parentNode.appendChild(details);
                    }

                    let todaysEvents = this.events.reduce(function(memo, ev) {
                        if(ev.date.isSame(day, 'day')) {
                            memo.push(ev);
                        }
                        return memo;
                    }, []);

                    this.renderEvents(todaysEvents, details);

                    arrow.style.left = el.offsetLeft - el.parentNode.offsetLeft + 27 + 'px';
                }

                Calendar.prototype.renderEvents = function(events, ele) {
                    //Remove any events in the current details element
                    let currentWrapper = ele.querySelector('.events');
                    let wrapper = createElement('div', 'events in' + (currentWrapper ? ' new' : ''));

                    events.forEach(function(ev) {
                        let div = createElement('div', 'event');
                        let square = createElement('div', 'event-category');
                        square.style = 'background:'+ ev.color;
                        let span = createElement('span', '', ev.eventName);

                        div.appendChild(square);
                        div.appendChild(span);
                        wrapper.appendChild(div);
                    });

                    if(!events.length) {
                        let div = createElement('div', 'event empty');
                        let span = createElement('span', '', 'No Reminders');

                        div.appendChild(span);
                        wrapper.appendChild(div);
                    }

                    if(currentWrapper) {
                        currentWrapper.className = 'events out';
                        currentWrapper.addEventListener('webkitAnimationEnd', function() {
                            currentWrapper.parentNode.removeChild(currentWrapper);
                            ele.appendChild(wrapper);
                        });
                        currentWrapper.addEventListener('oanimationend', function() {
                            currentWrapper.parentNode.removeChild(currentWrapper);
                            ele.appendChild(wrapper);
                        });
                        currentWrapper.addEventListener('msAnimationEnd', function() {
                            currentWrapper.parentNode.removeChild(currentWrapper);
                            ele.appendChild(wrapper);
                        });
                        currentWrapper.addEventListener('animationend', function() {
                            currentWrapper.parentNode.removeChild(currentWrapper);
                            ele.appendChild(wrapper);
                        });
                    } else {
                        ele.appendChild(wrapper);
                    }
                }

                Calendar.prototype.drawLegend = function() {
                    let legend = createElement('div', 'legend');
                    let calendars = this.events.map(function(e) {
                        return e.calendar + '|' + e.color;
                    }).reduce(function(memo, e) {
                        if(memo.indexOf(e) === -1) {
                            memo.push(e);
                        }
                        return memo;
                    }, []).forEach(function(e) {
                        let parts = e.split('|');
                        let entry = createElement('span', 'entry ' +  parts[1], parts[0]);
                        entry.style = '--dog-color: '+ parts[1];
                        legend.appendChild(entry);
                    });
                    this.el.appendChild(legend);
                }

                Calendar.prototype.nextMonth = function() {
                    this.current.add('months', 1);
                    this.next = true;
                    this.draw();
                }

                Calendar.prototype.prevMonth = function() {
                    this.current.subtract('months', 1);
                    this.next = false;
                    this.draw();
                }

                window.Calendar = Calendar;

                function createElement(tagName, className, innerText) {
                    let ele = document.createElement(tagName);
                    if(className) {
                        ele.className = className;
                    }
                    if(innerText) {
                        ele.innderText = ele.textContent = innerText;
                    }
                    return ele;
                }
            }();

            // Populate calendar events from php
            !function() {
                let data = [
                    <?php
                        foreach ($reminders as $reminder) {
                            echo "
                                { eventName: \"{$reminder["text"]}\", calendar: \"{$reminder["dog_name"]}\", color: stringToColour('{$reminder["dog_name"]}'), date: \"{$reminder["date"]}\"},
                            ";
                        }
                    ?>
                ];

                // Converts a string to a random, colour with high contrast (so 2 random colours are unlikely to be similar
                function stringToColour(str) {
                    let colour = '#' + md5(str).slice(0, 6);
                    return colour;
                }

                // Create the calendar object
                let calendar = new Calendar('#calendar', data);

            }();
        </script>
        <div class="clearfix"></div>
<?php
    }
?>