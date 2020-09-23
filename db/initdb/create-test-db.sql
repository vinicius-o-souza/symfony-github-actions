# Create vuc_test database if it doesn't exist
CREATE DATABASE IF NOT EXISTS vuc_test;

# Grant all privilidges on vuc_test to org_user
GRANT ALL PRIVILEGES ON vuc_test.* TO 'vuc' identified by 'vuc';