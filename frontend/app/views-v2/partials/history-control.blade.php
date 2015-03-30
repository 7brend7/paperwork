<div class="wayback-machine-container">
<div id="wayback-machine" class="freqselector">
    <div class="freqselector-fadeout-left freqselector-fadeout" ng-controller="WaybackController"></div>
    <div class="freqselector-fadeout-right freqselector-fadeout"></div>
    <div class="freqselector-arrow-top"></div>
    <div class="freqselector-arrow-bottom"></div>
    <div class="freqselector-background">
        <div class="freqselector-content">
            <div class="freqselector-item freqselector-item-dummy">
                <div id="freqselector-item-0" class="freqselector-item-snap"></div>
            </div>
            <div class="freqselector-item freqselector-item-not-dummy" ng-repeat="version in note.versions">
                <div id="freqselector-item-{{version.id}}" class="freqselector-item-snap" data-itemid="{{version.id}}" data-itemlatest="{{version.latest}}"></div>
                <div>
                    <div class="freqselector-item-title">{{version.timestamp * 1000 | date:'yyyy-MM-dd'}}</div>
                    <div class="freqselector-item-subtitle">{{version.timestamp * 1000 | date:'HH:mm'}}</div>
                </div>
            </div>
            <div class="freqselector-item freqselector-item-dummy">
                <div id="freqselector-item-999999" class="freqselector-item-snap"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
</div>