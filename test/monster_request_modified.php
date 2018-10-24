<?php 
$soap_request = '<?xml version="1.0" encoding="UTF-8"?>
					<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">
					  <SOAP-ENV:Header>
					    <mh:MonsterHeader xmlns:mh="http://schemas.monster.com/MonsterHeader">
					      <mh:MessageData>
					        <mh:MessageId>Company Jobs created on ' . date ( 'm/d/y h:i:s A' ) . '</mh:MessageId>
					        <mh:Timestamp>' . $timestamp . '</mh:Timestamp>
					      </mh:MessageData>
					    </mh:MonsterHeader>
					    <wsse:Security xmlns:wsse="http://schemas.xmlsoap.org/ws/2002/04/secext">
					      <wsse:UsernameToken>
					        <wsse:Username>' . $user_id . '</wsse:Username>
					        <wsse:Password>' . $password . '</wsse:Password>
					      </wsse:UsernameToken>
					    </wsse:Security>
					  </SOAP-ENV:Header>
					  <SOAP-ENV:Body>
					    <Job jobRefCode="' . $requisitioninfo ['RequestID'] . '" jobAction="addOrUpdate" jobComplete="true" xmlns="http://schemas.monster.com/Monster" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://schemas.monster.com/Monster http://schemas.monster.com/Current/xsd/Monster.xsd">
					      <RecruiterReference>
					        <UserName>' . $user_id . '</UserName>
					      </RecruiterReference>
					      <JobInformation>
					        <JobTitle>' . $requisitioninfo ['Title'] . '</JobTitle>
					        <JobLevel monsterId="12"/>
					        <JobType monsterId="1"/>
					        <JobStatus monsterId="4"/>
					        <Contact hideAll="false" hideAddress="true" hideStreetAddress="true" hideCity="true"
					        hideState="true" hidePostalCode="true" hideCountry="true" hideContactInfoField="false"
					        hideCompanyName="false" hideEmailAddress="true" hideFax="true"
					        hideName="false" hidePhone="true">
					          <Name>' . $userinfo ['FirstName'] . " " . $userinfo ['LastName'] . '</Name>
					          <CompanyName>' . $roworginfo ['OrganizationName'] . '</CompanyName>
					          <Address>
					            <StreetAddress>' . $requisitioninfo ['Address1'] . '</StreetAddress>
					            <StreetAddress2>' . $requisitioninfo ['Address1'] . '</StreetAddress2>
					            <City>' . $requisitioninfo ['City'] . '</City>
					            <State>' . $requisitioninfo ['State'] . '</State>
					            <CountryCode>' . $requisitioninfo ['Country'] . '</CountryCode>
					            <PostalCode>' . $requisitioninfo ['ZipCode'] . '</PostalCode>
					          </Address>
					          <Phones>
					            <Phone phoneType="work">' . $userinfo ['Phone'] . '</Phone>
					          </Phones>
					          <E-mail>' . $userinfo ['EmailAddress'] . '</E-mail>
					        </Contact>
					        <PhysicalAddress>
					          <StreetAddress>' . $requisitioninfo ['Address1'] . '</StreetAddress>
					          <StreetAddress2>' . $requisitioninfo ['Address2'] . '</StreetAddress2>
					          <City>' . $roworginfo ['City'] . '</City>
					          <State>' . $requisitioninfo ['State'] . '</State>
					          <CountryCode>' . $requisitioninfo ['Country'] . '</CountryCode>
					          <PostalCode>' . $requisitioninfo ['ZipCode'] . '</PostalCode>
					        </PhysicalAddress>
					        <DisableApplyOnline>true</DisableApplyOnline>
					        <HideCompanyInfo>false</HideCompanyInfo>
					        <JobBody>' . htmlentities ( $requisitioninfo ['Description'] ) . '</JobBody>
					        <ApplyWithMonster>
					          <DeliveryMethod monsterId="'.$DeliveryMethod.'"/>';

$soap_request .= 	'<DeliveryFormat monsterId="1"/>
					          <EmailAddress>' . $userinfo ['EmailAddress'] . '</EmailAddress>
					          <VendorText>' . $vendorfield . '</VendorText>';

if($DeliveryMethod == '1')
	$soap_request .= '<PostURL>' . $IRECRUIT_HOME . 'monster/saveMonsterApplicantInfo.php</PostURL>';
else
	$soap_request .= '<OnContinueURL>'.$PUBLIC_HOME.$monsterredirectlink.'</OnContinueURL>';

$soap_request .= 	'<ApiKey>'.$MonsterInfoObj->ApiKey.'</ApiKey>
					        </ApplyWithMonster>
					      </JobInformation>
					      <JobPostings>
					        <JobPosting desiredDuration="'.$Duration.'" bold="true">
					          <InventoryPreference>
					            <Autorefresh desired="true">
					              <Frequency>7</Frequency>
					            </Autorefresh>
					            <CareerAdNetwork desired="true">
					              <Duration>14</Duration>
					            </CareerAdNetwork>
					           </InventoryPreference>
					          <Location>
					            <City>' . $requisitioninfo ['City'] . '</City>
					            <State>' . $requisitioninfo ['State'] . '</State>
					            <CountryCode>' . $requisitioninfo ['Country'] . '</CountryCode>
					            <PostalCode>' . $requisitioninfo ['ZipCode'] . '</PostalCode>
					          </Location>
					          <JobCategory monsterId="' . $requisitioninfo ['MonsterJobCategory'] . '"/>
					          <JobOccupations>
					            <JobOccupation monsterId="' . $requisitioninfo ['MonsterJobOccupation'] . '"/>
					          </JobOccupations>
					          <BoardName monsterId="178"/>
					          <DisplayTemplate monsterId="1"/>
					          <Industries>
					            <Industry>
					              <IndustryName monsterId="'.$requisitioninfo['MonsterJobIndustry'].'"/>
					            </Industry>
					          </Industries>
					        </JobPosting>
					      </JobPostings>
					    </Job>
					  </SOAP-ENV:Body>
					</SOAP-ENV:Envelope>';
?>