<?php

namespace App\Listeners;

use App\AssessmentEconomicSituation;
use App\AssessmentHousholdProfile;
use App\AssessmentImpairmentType;
use App\AssessmentIndependenceParticipation;
use App\AssessmentNutrition;
use App\AssessmentProtection;
use App\AssessmentPsychosocial;
use App\AssessmentVulnerabilityType;
use App\BudgetActivity;
use App\Camp;
use App\CashProvision;
use App\CashProvisionClient;
use App\Client;
use App\ClientCase;
use App\ClientInformation;
use App\ClientNeed;
use App\ClientReferral;
use App\ClientVulnerabilityCode;
use App\Country;
use App\District;
use App\HomeAssessment;
use App\InventoryReceived;
use App\ItemReceived;
use App\ItemsCategories;
use App\ItemsDisbursement;
use App\ItemsDisbursementItems;
use App\ItemsInventory;
use App\NeedCategory;
use App\Origin;
use App\PCCashUsage;
use App\PCCashUsageCategory;
use App\PCCashWithdrawal;
use App\PCCategories;
use App\PCCommunalRelations;
use App\PCDemographicDetails;
use App\PCPhysicallyReceivingCash;
use App\PostCashAssessment;
use App\ProgressNote;
use App\PSNCode;
use App\PSNCodeCategory;
use App\ReceivingAgency;
use App\ReferralReason;
use App\ReferralServiceRequested;
use App\ReferringAgency;
use App\Region;
use App\RequestedService;
use App\VulnerabilityAssessment;
use App\Events\GenerateXMLDocumentEvent;
use App\Helpers\ExportXMLGeneratorUtility;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ExportXMLDocumentListener {

    private $xmlGenerator = null;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {
        $this->xmlGenerator = new ExportXMLGeneratorUtility();
    }

    /**
     * Handle the event.
     *
     * @param  GenerateXMLDocumentEvent  $event
     * @return void
     */
    public function handle(GenerateXMLDocumentEvent $event) {
        switch($event->getModule()) {
            case 1 :
                Client::chunk(1000, function($clients) {
                    $this->xmlGenerator->generateClients($clients);
                });
            break;
            case 2 :
                VulnerabilityAssessment::chunk(1000, function($assessments) {
                    $this->xmlGenerator->generateVulnerabilityAssessments($assessments);
                });
                HomeAssessment::chunk(1000, function($homeAssessments) {
                    $this->xmlGenerator->generateHomeAssessments($homeAssessments);
                });
            break;
            case 3 :
                ClientReferral::chunk(1000, function($clientReferrals) {
                    $this->xmlGenerator->generateClientReferrals($clientReferrals);
                });
            break;
            case 4 :
                ItemsInventory::chunk(1000, function($itemInventories) {
                    $this->xmlGenerator->generateClientReferrals($clientReferrals);
                });

                InventoryReceived::chunk(1000, function($receivedItems) {
                    $this->xmlGenerator->generateClientReferrals($clientReferrals);
                });

                ItemsDisbursement::chunk(1000, function($itemDisbursements) {
                    $this->xmlGenerator->generateItemDisbursements($itemDisbursements);
                });
            break;
            case 5 :
                BudgetActivity::chunk(1000, function($budgetActivities) {
                    $this->xmlGenerator->generateBudgetActivities($budgetActivities);
                });

                CashProvision::chunk(1000, function($cashProvisions) {
                    $this->xmlGenerator->generateCashProvisions($cashProvisions);
                });

                PostCashAssessment::chunk(1000, function($postCashAssessments) {
                    $this->xmlGenerator->generatePostCashAssessments($postCashAssessments);
                });
            break;
            case 6 :
                ClientCase::chunk(1000, function($clientCases) {
                    $this->xmlGenerator->generateClientCases($clientCases);
                });
                ProgressNote::chunk(1000, function($progressNotes) {
                    $this->xmlGenerator->generateProgressNotes($progressNotes);
                });
            break;
            default :
                Client::chunk(1000, function($clients) {
                    $this->xmlGenerator->generateClients($clients);
                });

                VulnerabilityAssessment::chunk(1000, function($assessments) {
                    $this->xmlGenerator->generateVulnerabilityAssessments($assessments);
                });
                HomeAssessment::chunk(1000, function($homeAssessments) {
                    $this->xmlGenerator->generateHomeAssessments($homeAssessments);
                });

                ClientReferral::chunk(1000, function($clientReferrals) {
                    $this->xmlGenerator->generateClientReferrals($clientReferrals);
                });

                ItemsInventory::chunk(1000, function($itemInventories) {
                    $this->xmlGenerator->generateClientReferrals($clientReferrals);
                });

                InventoryReceived::chunk(1000, function($receivedItems) {
                    $this->xmlGenerator->generateClientReferrals($clientReferrals);
                });

                ItemsDisbursement::chunk(1000, function($itemDisbursements) {
                    $this->xmlGenerator->generateItemDisbursements($itemDisbursements);
                });

                BudgetActivity::chunk(1000, function($budgetActivities) {
                    $this->xmlGenerator->generateBudgetActivities($budgetActivities);
                });

                CashProvision::chunk(1000, function($cashProvisions) {
                    $this->xmlGenerator->generateCashProvisions($cashProvisions);
                });

                PostCashAssessment::chunk(1000, function($postCashAssessments) {
                    $this->xmlGenerator->generatePostCashAssessments($postCashAssessments);
                });

                ClientCase::chunk(1000, function($clientCases) {
                    $this->xmlGenerator->generateClientCases($clientCases);
                });
                ProgressNote::chunk(1000, function($progressNotes) {
                    $this->xmlGenerator->generateProgressNotes($progressNotes);
                });
            break;
        }
    }
}
