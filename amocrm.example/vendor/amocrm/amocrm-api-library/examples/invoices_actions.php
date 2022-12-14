<?php

use AmoCRM\Enum\Invoices\BillStatusEnumCode;
use AmoCRM\Collections\LinksCollection;
use AmoCRM\Filters\CatalogsFilter;
use AmoCRM\Models\CustomFieldsValues\LinkedEntityCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\NumericCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\LinkedEntityCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\NumericCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueModels\LinkedEntityCustomFieldValueModel;
use AmoCRM\Collections\CustomFieldsValuesCollection;
use AmoCRM\Enum\InvoicesCustomFieldsEnums;
use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Helpers\EntityTypesInterface;
use AmoCRM\Models\CatalogElementModel;
use AmoCRM\Models\CustomFieldsValues\ItemsCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\LegalEntityCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\SelectCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\TextCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\ItemsCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\LegalEntityCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\SelectCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\TextCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueModels\ItemsCustomFieldValueModel;
use AmoCRM\Models\CustomFieldsValues\ValueModels\LegalEntityCustomFieldValueModel;
use AmoCRM\Models\CustomFieldsValues\ValueModels\NumericCustomFieldValueModel;
use AmoCRM\Models\CustomFieldsValues\ValueModels\SelectCustomFieldValueModel;
use AmoCRM\Models\CustomFieldsValues\ValueModels\TextCustomFieldValueModel;
use AmoCRM\Models\LeadModel;
use League\OAuth2\Client\Token\AccessTokenInterface;

include_once __DIR__ . '/bootstrap.php';

$accessToken = getToken();

$apiClient->setAccessToken($accessToken)
    ->setAccountBaseDomain($accessToken->getValues()['baseDomain'])
    ->onAccessTokenRefresh(
        function (AccessTokenInterface $accessToken, string $baseDomain) {
            saveToken(
                [
                    'accessToken' => $accessToken->getToken(),
                    'refreshToken' => $accessToken->getRefreshToken(),
                    'expires' => $accessToken->getExpires(),
                    'baseDomain' => $baseDomain,
                ]
            );
        }
    );

//?????????????? ???????????????? ????????????
try {
    $catalogsFilter = new CatalogsFilter();
    $catalogsFilter->setType(EntityTypesInterface::INVOICES_CATALOG_TYPE_STRING);
    $invoicesCatalog = $apiClient->catalogs()->get($catalogsFilter)->first();
} catch (AmoCRMApiException $e) {
    printError($e);
    die;
}

//?????????????? ?????????? ?? ???????????????? ???? ????????????
try {
    $invoicesCollection = $apiClient
        ->catalogElements($invoicesCatalog->getId())
        ->get(null, [CatalogElementModel::INVOICE_LINK]);
} catch (AmoCRMApiException $e) {
    printError($e);
    die;
}

//?????????????? ???????????? ????????
$invoice = $invoicesCollection->first();

//?????????????? ???????????? ???? ???????????????? ?????????? ??????????
if ($invoiceLink = $invoice->getInvoiceLink()) {
    var_dump($invoiceLink);
}

//?????????????? ???????????????? ??????????
$customFieldValues = $invoice->getCustomFieldsValues();

//?????????????? ???????????????? ???????? ????????????
if ($statusValue = $customFieldValues->getBy('fieldCode', InvoicesCustomFieldsEnums::STATUS)) {
    var_dump($statusValue->getValues()->first()->getValue());

    // ?????????????? ???????????? ?????????? ???? "???????????????? ??????????????"
    // ?????????????????? ?? ???????????????? ???????????????? ?? examples/custom_field_select_actions.php
    $statusCustomFieldValueModel = new SelectCustomFieldValuesModel();
    $statusCustomFieldValueModel->setFieldCode(InvoicesCustomFieldsEnums::STATUS);
    $statusCustomFieldValueModel->setValues(
        (new SelectCustomFieldValueCollection())
            ->add((new SelectCustomFieldValueModel())->setEnumCode(BillStatusEnumCode::PARTIALLY_PAID))
    );

    $apiClient->catalogElements($invoicesCatalog->getId())->updateOne(
        $invoice->setCustomFieldsValues(
            (new CustomFieldsValuesCollection())->add($statusCustomFieldValueModel)
        )
    );
}
//?????????????? ???????????????? ???????? ????. ????????
if ($legalEntityValue = $customFieldValues->getBy('fieldCode', InvoicesCustomFieldsEnums::LEGAL_ENTITY)) {
    var_dump($legalEntityValue->getValues()->first()->getValue());
}
//?????????????? ???????????????? ???????? ????????????????????
if ($payerValue = $customFieldValues->getBy('fieldCode', InvoicesCustomFieldsEnums::PAYER)) {
    var_dump($payerValue->getValues()->first()->getValue());
}
//?????????????? ???????????????? ?????????????????????? ????????????
if ($itemsValue = $customFieldValues->getBy('fieldCode', InvoicesCustomFieldsEnums::ITEMS)) {
    /** @var ItemsCustomFieldValueModel $value */
    foreach ($itemsValue->getValues() as $value) {
        var_dump($value->getValue());
    }
}
//?????????????? ???????????????? ???????? ??????????????????????
if ($commentField = $customFieldValues->getBy('fieldCode', InvoicesCustomFieldsEnums::COMMENT)) {
    var_dump($commentField->getValues()->first()->getValue());
}
//?????????????? ???????????????? ???????? ???????????????? ?????????? ?? ????????????
if ($priceValue = $customFieldValues->getBy('fieldCode', InvoicesCustomFieldsEnums::PRICE)) {
    var_dump($priceValue->getValues()->first()->getValue());
}
//?????????????? ???????????????? ???????? ?????? ??????
if ($vatValue = $customFieldValues->getBy('fieldCode', InvoicesCustomFieldsEnums::VAT_TYPE)) {
    var_dump($vatValue->getValues()->first()->getValue());
}
//?????????????? ???????????????? ???????? ???????? ????????????, ?????????? ????????????????, ???????????? ???????? ???????? ?? ?????????????? ??????????????
if ($paymentDateValue = $customFieldValues->getBy('fieldCode', InvoicesCustomFieldsEnums::PAYMENT_DATE)) {
    var_dump($paymentDateValue->getValues()->first()->getValue());
}


//???????????????? ?????????? ????????
//?????????????????????? ???????????? ???????? ???????????????? ?? ?????????????????? ???????? ????????????
$newInvoice = new CatalogElementModel();
//?????????????? ??????
$newInvoice->setName('???????? #238');
//?????????????? ???????? ????????????????
$creationDate = new DateTime('2021-05-15 10:00:00');
$newInvoice->setCreatedAt($creationDate->getTimestamp());

$invoiceCustomFieldsValues = new CustomFieldsValuesCollection();
//?????????????? ????????????
$statusCustomFieldValueModel = new SelectCustomFieldValuesModel();
$statusCustomFieldValueModel->setFieldCode(InvoicesCustomFieldsEnums::STATUS);
$statusCustomFieldValueModel->setValues(
    (new SelectCustomFieldValueCollection())
        ->add((new SelectCustomFieldValueModel())->setValue('?????????????? ?? ??????????')) //?????????? ???????????? ?????????????????? ?? ?????????? ???? ???????????????? ???????? ????????????
);
$invoiceCustomFieldsValues->add($statusCustomFieldValueModel);
//?????????????? ??????????????????????
$commentCustomFieldValueModel = new TextCustomFieldValuesModel();
$commentCustomFieldValueModel->setFieldCode(InvoicesCustomFieldsEnums::COMMENT);
$commentCustomFieldValueModel->setValues(
    (new TextCustomFieldValueCollection())
        ->add((new TextCustomFieldValueModel())->setValue('?????????? ?????????????????????? ?? ??????????'))
);
$invoiceCustomFieldsValues->add($commentCustomFieldValueModel);
//?????????????? ?????????????????????? (???? ???????? ?????????????????? ????????????????, ?????????? ?????????????? ?? ???????? ?????????? ?? ?????????????????? (?????????????? ?????? ????????????????))
$payerCustomFieldValueModel = new LinkedEntityCustomFieldValuesModel();
$payerCustomFieldValueModel->setFieldCode(InvoicesCustomFieldsEnums::PAYER);
$payerCustomFieldValueModel->setValues(
    (new LinkedEntityCustomFieldValueCollection())
        ->add(
            (new LinkedEntityCustomFieldValueModel())
                //->setName('???????? ????????????') //?????????? ???????????????? ?????? ???????????????? ????????????????, ?????? ID ????????????????, ?????????? ?????????????????? ?????? ????????
                ->setEntityId(11014723)
                ->setEntityType(EntityTypesInterface::CONTACTS)
        )
);
$invoiceCustomFieldsValues->add($payerCustomFieldValueModel);
//?????????????? ????. ????????, ???? ?????????? ???????????????? ?????????????????? ????????
$legalEntityCustomFieldValueModel = new LegalEntityCustomFieldValuesModel();
$legalEntityCustomFieldValueModel->setFieldCode(InvoicesCustomFieldsEnums::LEGAL_ENTITY);
$legalEntityCustomFieldValueModel->setValues(
    (new LegalEntityCustomFieldValueCollection())
        ->add(
            (new LegalEntityCustomFieldValueModel())
                ->setName('?????? "???????? ?? ????????????"')
                ->setLegalEntityType(LegalEntityCustomFieldValueModel::LEGAL_ENTITY_TYPE_JURIDICAL_PERSON)
                ->setVatId('05124214')
                ->setTaxRegistrationReasonCode('0124125125')
                ->setAddress('????????????, ?????????????? ??????????????, ?????? 1')
                ->setKpp('124352279')
                ->setBankCode('023532795')
                ->setExternalUid('125125-4457xcsf-erhery')
        )
);
$invoiceCustomFieldsValues->add($legalEntityCustomFieldValueModel);
//?????????????? ???????????? ?? ??????????
$itemsCustomFieldValueModel = new ItemsCustomFieldValuesModel();
$itemsCustomFieldValueModel->setFieldCode(InvoicesCustomFieldsEnums::ITEMS);
$itemsCustomFieldValueModel->setValues(
    (new ItemsCustomFieldValueCollection())
        ->add(
            (new ItemsCustomFieldValueModel())
                ->setDescription('???????????????? ????????????')
                ->setExternalUid('ID ???????????? ???? ?????????????? ?????????????? ??????????????')
                //->setProductId('ID ???????????? ?? ???????????? ?????????????? ?? amoCRM') //???????????????????????????? ????????
                ->setQuantity(10) //????????????????????
                ->setSku('?????????????? ????????????')
                ->setUnitPrice(150) //???????? ???? ?????????????? ????????????
                ->setUnitType('????') //?????????????? ?????????????????? ????????????
                ->setVatRateValue(20) //?????? 20%
                ->setDiscount([
                    'type' => ItemsCustomFieldValueModel::FIELD_DISCOUNT_TYPE_AMOUNT, //amount - ???????????? ????????????????????, percentage - ???????????? ?? ?????????????????? ???? ?????????????????? ????????????
                    'value' => 15.15 //15 ???????????? 15 ????????????
                ])
                ->setBonusPointsPerPurchase(20) //?????????????? ???????????????? ???????????? ?????????? ?????????????????? ???? ??????????????
        )
);
$invoiceCustomFieldsValues->add($itemsCustomFieldValueModel);
//?????????????? ???????????????? ???????? ???????????????? ?????????? ?? ????????????
//???????????????????????? ?? ???????????? ????????????,
//?????? ???????????? ?? ???????????????? ??????????, ?????????????????? ?????????? ?????????? ???????????????????? ?? ???????????? ??????????????, ?????? ?? ???????????????????? ?? ???????????????? ??????????
//???????? ???????????????? ???????????????????????? ??????????, ???? ???? ???????????????????????????? ?? ????????????????????, ?????????? API ?????????? ???????????????????????? ???????????????????????? ??????????
$priceCustomFieldValueModel = new NumericCustomFieldValuesModel();
$priceCustomFieldValueModel->setFieldCode(InvoicesCustomFieldsEnums::PRICE);
$priceCustomFieldValueModel->setValues(
    (new NumericCustomFieldValueCollection())
        ->add(
            (new NumericCustomFieldValueModel())
                ->setValue(100)
        )
);
$invoiceCustomFieldsValues->add($priceCustomFieldValueModel);
//?????????????? ?????? ??????
$vatTypeCustomFieldValueModel = new SelectCustomFieldValuesModel();
$vatTypeCustomFieldValueModel->setFieldCode(InvoicesCustomFieldsEnums::VAT_TYPE);
$vatTypeCustomFieldValueModel->setValues(
    (new SelectCustomFieldValueCollection())
        ->add((new SelectCustomFieldValueModel())->setValue("?????? ?????????????????????? ???????????? ??????????????????"))
);
$invoiceCustomFieldsValues->add($vatTypeCustomFieldValueModel);

//?????????????????? ???????????????? ?? ???????????? ?? ????????????????
$newInvoice->setCustomFieldsValues($invoiceCustomFieldsValues);
$catalogElementsService = $apiClient->catalogElements($invoicesCatalog->getId());
try {
    $newInvoice = $catalogElementsService->addOne($newInvoice);
    var_dump('ID ?????????? - ' . $newInvoice->getId());
} catch (AmoCRMApiException $e) {
    printError($e);
    die;
}

//???????????? ???????? ???? ?????????????? ?? ID 7856057
$leadsService = $apiClient->leads();
$lead = (new LeadModel())
    ->setId(7856057);
try {
    $leadsService->link($lead, (new LinksCollection())->add($newInvoice));
} catch (AmoCRMApiException $e) {
    printError($e);
    die;
}

//?????????????? ???????????? ??????????, ?????? ?????????????????? ???????????? ??????????
$invoiceForUpdate = (new CatalogElementModel())
    ->setId($newInvoice->getId())
    ->setCatalogId($invoicesCatalog->getId())
    ->setCustomFieldsValues(
        (new CustomFieldsValuesCollection())
            ->add(
                (new SelectCustomFieldValuesModel())
                    ->setFieldCode(InvoicesCustomFieldsEnums::STATUS)
                    ->setValues(
                        (new SelectCustomFieldValueCollection())
                            ->add((new SelectCustomFieldValueModel())->setValue('??????????????')) //?????????? ???????????? ?????????????????? ?? ?????????? ???? ???????????????? ???????? ????????????
                    )
            )
    );

try {
    $updatedInvoice = $catalogElementsService->updateOne($invoiceForUpdate);
    var_dump('ID ???????????????????????? ?????????? - ' . $updatedInvoice->getId());
} catch (AmoCRMApiException $e) {
    printError($e);
    die;
}

//?????????????? ???????????????? ???????? ????????????
$invoicesCfService = $apiClient->customFields(EntityTypesInterface::CATALOGS . ':' . $invoicesCatalog->getId());
try {
    $invoicesCfsCollection = $invoicesCfService->get();
} catch (AmoCRMApiException $e) {
    printError($e);
    die;
}
$invoiceStatusField = $invoicesCfsCollection->getBy('code', InvoicesCustomFieldsEnums::STATUS);
foreach ($invoiceStatusField->getEnums() as $enum) {
    var_dump('???????????????? ???????? ' . $enum->getValue() . ' ?? ID ' . $enum->getId());
}
