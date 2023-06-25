<?php
namespace Core;

use Core\DateTimeHelper;
use DOMElement;
use DOMDocument;

class Calendar 
{
    /**
     * Get current year
     * 
     * @var int $currentYear
     */
    private int $currentYear;

    /**
     * Object of DOMDOMDocument class
     * @var DOMDocument $nodeObj
     */
    private $nodeObj = null;
    
    /**
     * Array of days in a week
     * @var array $daysOfWeek
     */
    private $daysOfweek;

    /**
     * Accept and set object properties
     * 
     * @param int $currentYear
     */
    public function __construct(int $currentYear) {
        $this->currentYear = $currentYear;
        $this->nodeObj = new DOMDocument('0.1', 'iso-8859-1');
        $this->daysOfweek = [
<<<<<<< HEAD
            'Sun',
            'Mon',
            'Tue',
            'Wed',
            'Thu',
            'Fri',
            'Sat'
=======
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday'
>>>>>>> 1f56c35c9e5452b30f1b90b015328061971111a0
        ];
    }

    /**
     * Initialize calendar
     * 
     * @return array
     */
    private function initialize(): array
    {
        $monthsArray = cal_info(0);
        return $monthsArray;
    }

    /**
     * Return days of month
     * 
     * @return array
     */
    private function getDaysOfMonths(): array
    {
        $calendarInfo = $this->initialize();
        $monthsArray = $calendarInfo['months'];
        $year = $this->currentYear;

        $daysOfMonthsArr = array_map(function ($monthArr, $monthIndex) use ($year)
        {            
            $monthInfoArr[$monthIndex] = [
                'name' => $monthArr,
                'days_of_month' => cal_days_in_month(CAL_GREGORIAN, $monthIndex, $year),
            ];
            return $monthInfoArr[$monthIndex];
        },
        $monthsArray, array_keys($monthsArray));

        # REMOVE 0 INDEX FORM THE ARRAY
        array_unshift($daysOfMonthsArr, "");
        unset($daysOfMonthsArr[0]);

        return $daysOfMonthsArr;
    }

    /**
     * Create dynamic html element
     * 
     * @param mixed $htmlTag
     * @param mixed $content
     * @param mixed $attributesArr
     * @return DOMElement
     */
    private function createHtmlElement(string $htmlTag, string $content = null, array $attributesArr = []): DOMElement
    {
        $nodeObj = $this->nodeObj;
        $htmlElement = $nodeObj->createElement($htmlTag, $content);

        foreach ($attributesArr as $attributeName => $attributeValue) {
            $htmlElement->setAttribute($attributeName, $attributeValue);            
        }        
        
        return $htmlElement;
    }

    /**
     * Create table heading contains day names
     * 
     * @return DOMElement
     */
    private function daysHeadingRow(): DOMElement
    {
        $daysOfWeek = $this->daysOfweek;
<<<<<<< HEAD

        $theadAttributes = [
            'class' => "calendar__month--days-heading"
        ];

        $thead = $this->createHtmlElement("thead", null, $theadAttributes);
=======
        $thead = $this->createHtmlElement("thead");
>>>>>>> 1f56c35c9e5452b30f1b90b015328061971111a0
        $tr = $this->createHtmlElement("tr");

        foreach ($daysOfWeek as $day) {
            $th = $this->createHtmlElement("th", $day, ['id' => $day]);
            $tr->appendChild($th);
        }
        $thead->appendChild($tr);
        return $thead;
    }

    /**
     * Create month year caption
     * 
     * @param mixed $year
     * @param mixed $month
     * @return DOMElement
     */
    private function monthYearCaption(int $year, int $month): DOMElement
    {
        $dateObj = new DateTimeHelper();
        $date = $dateObj->initialze("$year-$month-01");
        $getYear = $date->format("Y");
        $getMonth = $date->format("F");
<<<<<<< HEAD

        $captionAttributes = [
            'class' => "calendar__month--caption",
        ];

        $caption = $this->createHtmlElement("caption", "$getMonth $getYear", $captionAttributes);
=======
        $caption = $this->createHtmlElement("caption", "$getMonth $getYear");
>>>>>>> 1f56c35c9e5452b30f1b90b015328061971111a0

        return $caption;
    }

    /**
     * Generate date cells 
     * 
     * @param mixed $year
     * @param mixed $month
     * @return DOMElement
     */
    private function generateDateCells(int $year, int $month): DOMElement
    {        
        $dateObj = new DateTimeHelper();
        $dateStr = "$year-$month-01";
        $currentDate = ($year && $month) ? $dateObj->initialze($dateStr) : $dateObj->today();

<<<<<<< HEAD
        $tbodyAttributes = [
            'class' => "calendar__month--dates",
        ];

        $tbody = $this->createHtmlElement('tbody', null, $tbodyAttributes);
=======
        $tbody = $this->createHtmlElement('tbody');
>>>>>>> 1f56c35c9e5452b30f1b90b015328061971111a0
        $tr = $this->createHtmlElement("tr");
        
        $currentWeekDayCounter = $currentDate->format('w');

        for ($emptyCell=1; $emptyCell < ($currentWeekDayCounter + 1); $emptyCell++) {
<<<<<<< HEAD
            $tdAttributes = [
                'class' => "calendar__month--date empty",
                'aria-disabled' => "true",
                'aria-invalid' => "false",
            ];
            $td = $this->createHtmlElement("td", "&nbsp;", $tdAttributes);
=======
            $td = $this->createHtmlElement("td", "&nbsp;");
>>>>>>> 1f56c35c9e5452b30f1b90b015328061971111a0
            $tr->appendChild($td);
        }

        $dayCounter = 1;
        $daysInMonth = $currentDate->format("t");

        while ($dayCounter <= $daysInMonth) {
<<<<<<< HEAD
            $calendarDate = $dateObj->initialze($currentDate->format("Y") . "-" . $currentDate->format("m") . "-$dayCounter");
            $tdAttributes = [
                'id' => "date" . $calendarDate->getTimestamp(),
                'class' => "calendar__month--date",
                'data-date' => $calendarDate->format('Y-m-d'),
                'aria-disabled' => "false",
            ];

            $td = $this->createHtmlElement("td", $dayCounter, $tdAttributes);
=======
            $td = $this->createHtmlElement("td", $dayCounter);
>>>>>>> 1f56c35c9e5452b30f1b90b015328061971111a0
            $tr->appendChild($td);
            
            $dayCounter++;
            $currentWeekDayCounter = ($currentWeekDayCounter + 1) % 7;

            if ($currentWeekDayCounter === 0) {
                $tbody->appendChild($tr);
                $tr = $this->createHtmlElement("tr");
            }
        }

        while ($currentWeekDayCounter !== 0) {
<<<<<<< HEAD
            $tdAttributes = [
                'class' => "calendar__month--date empty",
                'aria-disabled' => "true",
                'aria-invalid' => "false",
            ];
            $td = $this->createHtmlElement("td", "&nbsp;", $tdAttributes);
=======
            $td = $this->createHtmlElement("td", "&nbsp;");
>>>>>>> 1f56c35c9e5452b30f1b90b015328061971111a0
            $tr->appendChild($td);
            $currentWeekDayCounter = ($currentWeekDayCounter + 1) % 7;
        }

        $tbody->appendChild($tr);

        return $tbody;
    }

    /**
     * Generate monthly calendar
     * 
     * @param mixed $year
     * @param mixed $month
     * @return DOMElement
     */
    private function generateMonthlyCalendar(int $year, int $month): DOMElement
    {
<<<<<<< HEAD
        $tableAttributes = [
            'class' => "calendar__month",
        ];
        $table = $this->createHtmlElement("table", null, $tableAttributes);
=======
        $table = $this->createHtmlElement("table");
>>>>>>> 1f56c35c9e5452b30f1b90b015328061971111a0

        $caption = $this->monthYearCaption($year, $month);
        $table->appendChild($caption);

        $thead = $this->daysHeadingRow();
        $table->appendChild($thead);

        $tbody = $this->generateDateCells($year, $month);

        $table->appendChild($tbody);

        return $table;
    }

    /**
     * Generate year calendar
     * 
     * @param mixed $year
     * @return DOMElement
     */
    private function generateYearlyCalendar(int $year = null)
    {
<<<<<<< HEAD
        $sectionAttributes = [
            'id' => "calendar",
            'class' => "calendar",
        ];
        $calendar = $this->createHtmlElement("section", null, $sectionAttributes);
=======
        $calendar = $this->createHtmlElement("section", null, ['id' => "calendar"]);
>>>>>>> 1f56c35c9e5452b30f1b90b015328061971111a0
        $currentYear = $year ?? $this->currentYear;
        $months = $this->getDaysOfMonths();

        foreach ($months as $monthIndex => $monthData) {
            $monthCalendar = $this->generateMonthlyCalendar($currentYear, $monthIndex);

            $calendar->appendChild($monthCalendar);
        }

        return $calendar;
    }

    /**
     * Return table html string
     * 
     * @return bool|string
     */
    public function __toString()
    {
        $nodeObj = $this->nodeObj;
        $calendar = $this->generateYearlyCalendar();
        $nodeObj->appendChild($calendar);
        $htmlString = $nodeObj->saveHTML();

        return $htmlString;
    }
}
