<?php
// This file was auto-generated from sdk-root/src/data/logs/2014-03-28/api-2.json
return [ 'version' => '2.0', 'metadata' => [ 'apiVersion' => '2014-03-28', 'endpointPrefix' => 'logs', 'jsonVersion' => '1.1', 'protocol' => 'json', 'serviceFullName' => 'Amazon CloudWatch Logs', 'serviceId' => 'CloudWatch Logs', 'signatureVersion' => 'v4', 'targetPrefix' => 'Logs_20140328', 'uid' => 'logs-2014-03-28', ], 'operations' => [ 'AssociateKmsKey' => [ 'name' => 'AssociateKmsKey', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'AssociateKmsKeyRequest', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'OperationAbortedException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'CancelExportTask' => [ 'name' => 'CancelExportTask', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'CancelExportTaskRequest', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'InvalidOperationException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'CreateExportTask' => [ 'name' => 'CreateExportTask', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'CreateExportTaskRequest', ], 'output' => [ 'shape' => 'CreateExportTaskResponse', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'OperationAbortedException', ], [ 'shape' => 'ServiceUnavailableException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'ResourceAlreadyExistsException', ], ], ], 'CreateLogGroup' => [ 'name' => 'CreateLogGroup', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'CreateLogGroupRequest', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ResourceAlreadyExistsException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'OperationAbortedException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'CreateLogStream' => [ 'name' => 'CreateLogStream', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'CreateLogStreamRequest', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ResourceAlreadyExistsException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'DeleteDestination' => [ 'name' => 'DeleteDestination', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DeleteDestinationRequest', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'OperationAbortedException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'DeleteLogGroup' => [ 'name' => 'DeleteLogGroup', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DeleteLogGroupRequest', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'OperationAbortedException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'DeleteLogStream' => [ 'name' => 'DeleteLogStream', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DeleteLogStreamRequest', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'OperationAbortedException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'DeleteMetricFilter' => [ 'name' => 'DeleteMetricFilter', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DeleteMetricFilterRequest', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'OperationAbortedException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'DeleteResourcePolicy' => [ 'name' => 'DeleteResourcePolicy', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DeleteResourcePolicyRequest', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'DeleteRetentionPolicy' => [ 'name' => 'DeleteRetentionPolicy', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DeleteRetentionPolicyRequest', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'OperationAbortedException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'DeleteSubscriptionFilter' => [ 'name' => 'DeleteSubscriptionFilter', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DeleteSubscriptionFilterRequest', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'OperationAbortedException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'DescribeDestinations' => [ 'name' => 'DescribeDestinations', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeDestinationsRequest', ], 'output' => [ 'shape' => 'DescribeDestinationsResponse', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'DescribeExportTasks' => [ 'name' => 'DescribeExportTasks', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeExportTasksRequest', ], 'output' => [ 'shape' => 'DescribeExportTasksResponse', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'DescribeLogGroups' => [ 'name' => 'DescribeLogGroups', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeLogGroupsRequest', ], 'output' => [ 'shape' => 'DescribeLogGroupsResponse', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'DescribeLogStreams' => [ 'name' => 'DescribeLogStreams', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeLogStreamsRequest', ], 'output' => [ 'shape' => 'DescribeLogStreamsResponse', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'DescribeMetricFilters' => [ 'name' => 'DescribeMetricFilters', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeMetricFiltersRequest', ], 'output' => [ 'shape' => 'DescribeMetricFiltersResponse', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'DescribeQueries' => [ 'name' => 'DescribeQueries', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeQueriesRequest', ], 'output' => [ 'shape' => 'DescribeQueriesResponse', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'DescribeResourcePolicies' => [ 'name' => 'DescribeResourcePolicies', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeResourcePoliciesRequest', ], 'output' => [ 'shape' => 'DescribeResourcePoliciesResponse', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'DescribeSubscriptionFilters' => [ 'name' => 'DescribeSubscriptionFilters', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeSubscriptionFiltersRequest', ], 'output' => [ 'shape' => 'DescribeSubscriptionFiltersResponse', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'DisassociateKmsKey' => [ 'name' => 'DisassociateKmsKey', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DisassociateKmsKeyRequest', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'OperationAbortedException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'FilterLogEvents' => [ 'name' => 'FilterLogEvents', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'FilterLogEventsRequest', ], 'output' => [ 'shape' => 'FilterLogEventsResponse', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'GetLogEvents' => [ 'name' => 'GetLogEvents', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'GetLogEventsRequest', ], 'output' => [ 'shape' => 'GetLogEventsResponse', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'GetLogGroupFields' => [ 'name' => 'GetLogGroupFields', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'GetLogGroupFieldsRequest', ], 'output' => [ 'shape' => 'GetLogGroupFieldsResponse', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'GetLogRecord' => [ 'name' => 'GetLogRecord', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'GetLogRecordRequest', ], 'output' => [ 'shape' => 'GetLogRecordResponse', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'GetQueryResults' => [ 'name' => 'GetQueryResults', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'GetQueryResultsRequest', ], 'output' => [ 'shape' => 'GetQueryResultsResponse', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'ListTagsLogGroup' => [ 'name' => 'ListTagsLogGroup', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ListTagsLogGroupRequest', ], 'output' => [ 'shape' => 'ListTagsLogGroupResponse', ], 'errors' => [ [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'PutDestination' => [ 'name' => 'PutDestination', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'PutDestinationRequest', ], 'output' => [ 'shape' => 'PutDestinationResponse', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'OperationAbortedException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'PutDestinationPolicy' => [ 'name' => 'PutDestinationPolicy', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'PutDestinationPolicyRequest', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'OperationAbortedException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'PutLogEvents' => [ 'name' => 'PutLogEvents', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'PutLogEventsRequest', ], 'output' => [ 'shape' => 'PutLogEventsResponse', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'InvalidSequenceTokenException', ], [ 'shape' => 'DataAlreadyAcceptedException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'ServiceUnavailableException', ], [ 'shape' => 'UnrecognizedClientException', ], ], ], 'PutMetricFilter' => [ 'name' => 'PutMetricFilter', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'PutMetricFilterRequest', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'OperationAbortedException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'PutResourcePolicy' => [ 'name' => 'PutResourcePolicy', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'PutResourcePolicyRequest', ], 'output' => [ 'shape' => 'PutResourcePolicyResponse', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'PutRetentionPolicy' => [ 'name' => 'PutRetentionPolicy', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'PutRetentionPolicyRequest', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'OperationAbortedException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'PutSubscriptionFilter' => [ 'name' => 'PutSubscriptionFilter', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'PutSubscriptionFilterRequest', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'OperationAbortedException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'StartQuery' => [ 'name' => 'StartQuery', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'StartQueryRequest', ], 'output' => [ 'shape' => 'StartQueryResponse', ], 'errors' => [ [ 'shape' => 'MalformedQueryException', ], [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'StopQuery' => [ 'name' => 'StopQuery', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'StopQueryRequest', ], 'output' => [ 'shape' => 'StopQueryResponse', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'TagLogGroup' => [ 'name' => 'TagLogGroup', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'TagLogGroupRequest', ], 'errors' => [ [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'InvalidParameterException', ], ], ], 'TestMetricFilter' => [ 'name' => 'TestMetricFilter', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'TestMetricFilterRequest', ], 'output' => [ 'shape' => 'TestMetricFilterResponse', ], 'errors' => [ [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ServiceUnavailableException', ], ], ], 'UntagLogGroup' => [ 'name' => 'UntagLogGroup', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'UntagLogGroupRequest', ], 'errors' => [ [ 'shape' => 'ResourceNotFoundException', ], ], ], ], 'shapes' => [ 'AccessPolicy' => [ 'type' => 'string', 'min' => 1, ], 'Arn' => [ 'type' => 'string', ], 'AssociateKmsKeyRequest' => [ 'type' => 'structure', 'required' => [ 'logGroupName', 'kmsKeyId', ], 'members' => [ 'logGroupName' => [ 'shape' => 'LogGroupName', ], 'kmsKeyId' => [ 'shape' => 'KmsKeyId', ], ], ], 'CancelExportTaskRequest' => [ 'type' => 'structure', 'required' => [ 'taskId', ], 'members' => [ 'taskId' => [ 'shape' => 'ExportTaskId', ], ], ], 'CreateExportTaskRequest' => [ 'type' => 'structure', 'required' => [ 'logGroupName', 'from', 'to', 'destination', ], 'members' => [ 'taskName' => [ 'shape' => 'ExportTaskName', ], 'logGroupName' => [ 'shape' => 'LogGroupName', ], 'logStreamNamePrefix' => [ 'shape' => 'LogStreamName', ], 'from' => [ 'shape' => 'Timestamp', ], 'to' => [ 'shape' => 'Timestamp', ], 'destination' => [ 'shape' => 'ExportDestinationBucket', ], 'destinationPrefix' => [ 'shape' => 'ExportDestinationPrefix', ], ], ], 'CreateExportTaskResponse' => [ 'type' => 'structure', 'members' => [ 'taskId' => [ 'shape' => 'ExportTaskId', ], ], ], 'CreateLogGroupRequest' => [ 'type' => 'structure', 'required' => [ 'logGroupName', ], 'members' => [ 'logGroupName' => [ 'shape' => 'LogGroupName', ], 'kmsKeyId' => [ 'shape' => 'KmsKeyId', ], 'tags' => [ 'shape' => 'Tags', ], ], ], 'CreateLogStreamRequest' => [ 'type' => 'structure', 'required 