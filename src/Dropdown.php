<?php

namespace Donstrange\DropdownPhp {
    class Dropdown
    {
        static private $dropdowns = [];

        private $entries = [];

        private $title = null;
        private $id;

        function __construct($id)
        {
            self::$dropdowns[] = $this;
            $this->id = $id;
        }
        /**
         * Loads all dependent files as script/style tag. Use this in <head>
         *
         * @return string
         */
        public static function getAssets(): string
        {
            // $jsData = file_get_contents(__DIR__ . "/../assets/micromodal.js");
            $cssData = file_get_contents(__DIR__ . "/../assets/dropdown.css");
            // $tabCss = file_get_contents(__DIR__ . "/../assets/tabs.css");
            $init = file_get_contents(__DIR__ . "/../assets/init.js");
            return "<style>" . $cssData . "</style>" . "<script>" . $init . "</script>";
        }

        public static function getAllDropdowns(): string
        {
            return join("", array_map(function (Dropdown $dd) {
                return $dd->render();
            }, self::$dropdowns, []));
        }

        public function setTitle(?string $title)
        {
            $this->title = $title;
        }

        private function renderTitle() {
            if (!is_null($this->title)) {
                return "<div class='entry title divider'>" . $this->title . "</div>";
            } else {
                return "";
            }
        }

        public function addEntry(string $actionId, string $label, array $classes = [])
        {
            $this->entries[] = ["actionId" => $actionId, "label" => $label, "classes" => $classes];
        }

        private function renderEntries(): string {
            return join("", array_map(function ($entry) {
                $customClasses = join(" ", array_merge(["entry"], $entry["classes"]));

                return "<div class='" . $customClasses . "' data-action-id='" . $entry["actionId"] . "'>" . $entry["label"]."</div>";
            }, $this->entries));
        }

        public function getOpenButton(): string {
            return join("", [
                "<button type='button' data-dropdown-trigger='".$this->id."'>" . $this->title . " (Debug)</button>"
            ]);
        }

        public function render(): string
        {
            return join("", [
                "<div class='dropdown' data-dropdown-id='" . $this->id . "'>",
                "<div class='background'></div>",
                $this->renderTitle(),
                $this->renderEntries(),
                // join("", $entries),
                "</div>"
            ]);
        }
    }
}
