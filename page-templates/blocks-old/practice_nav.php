<?php
$mb = is_page('practice-areas') ? '' : 'mb-4';
?>
<!-- practice_nav -->
<div class="bg--sand-100 practice_nav py-5 <?=$mb?>">
    <div class="container pt-3">
        <?php
        if (!is_page('practice-areas')) {
            echo '<h2>Practice Areas</h2>';
        }
        ?>
        <div class="row">
            <div class="col-md-6 col-lg-3 pb-4 pa">
            <a href="/automotive-law/">
                <div class="practice-area" id="automotive">
                    <div class="key-letter">A</div>
                    <div class="section-title">Automotive<br>Law</div>
                    <div class="section-desc">No one has more product knowledge or knows the retail motor industry better than the car lawyer.</div>
                </div>
            </a>
            </div>
            <div class="col-md-6 col-lg-3 pb-4 pa">
            <a href="/business-law/">
                <div class="practice-area" id="business">
                    <div class="key-letter">B</div>
                    <div class="section-title">Business<br>Law</div>
                    <div class="section-desc">A business lawyer is an important asset to the health and success of your small business or company.</div>
                </div>
            </a>
            </div>
            <div class="col-md-6 col-lg-3 pb-4 pa">
            <a href="/construction-law/">
                <div class="practice-area" id="construction">
                    <div class="key-letter">C</div>
                    <div class="section-title">Construction<br>Law</div>
                    <div class="section-desc">We advise building firms and their clients in all aspects of construction and development.</div>
                </div>
            </a>
            </div>
            <div class="col-md-6 col-lg-3 pb-4 pa">
            <a href="/dispute-resolution/">
                <div class="practice-area" id="dispute">
                    <div class="key-letter">D</div>
                    <div class="section-title">Dispute<br>Resolution</div>
                    <div class="section-desc">We work to resolve all kinds of disputes cost-effectively, for companies and individuals alike.</div>
                </div>
            </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 pb-4 pa">
            <a href="/legal-advice/">
                <div class="practice-area text-center align-self-center section-title" id="legal">Legal Advice</div>
            </a>
            </div>
            <div class="col-md-6 pb-4 pa">
            <a href="/yacht-law/">
                <div class="practice-area text-center align-self-center section-title" id="yacht">Yacht Law</div>
            </a>
            </div>
        </div>
    </div>
</div>