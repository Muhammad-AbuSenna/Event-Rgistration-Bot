<?php
//to get the {{cloudOrg}} and {{cloudTenant}} used in Api calls flow this: https://docs.uipath.com/automation-cloud/docs/api-keys#viewing-api-access-information

define("_OAuth_endpoint","https://cloud.uipath.com/identity_/connect/token"); //check https://docs.uipath.com/automation-cloud/docs/setting-up-the-external-application#client-credentials

define("_client_id",'{{Your App id}}'); //check https://docs.uipath.com/automation-cloud/docs/managing-external-applications

define("_client_secret",'{{Your App secret}}');

define("_scope",'{{Your App Scope}}');

define("_add_queue_item_endpoint","https://cloud.uipath.com/{{cloudOrg}}/{{cloudTenant}}/orchestrator_/odata/Queues/UiPathODataSvc.AddQueueItem"); //Check https://postman.uipath.rocks/#58fadde2-0a93-4074-8955-b2639f77795b

define("_UnitId",'{{Queue folder id}}'); //this is the FolderId of the folder containing the queue, you can get folder id by accessing the folder on orchestrator and look for "fid" parameter on URL

define("_Queue_name",'{{queue name}}');

?>