# Ready To Innovate
Ready to Innovate tests organization's readiness to adopt emerging technologies. 
Ready to Innovate shows that a holistic strategy can allow organizations to make the changes they need to meet new demands in the IT industry.

## Running Locally
### Requirements
* PHP
* MySQL
* Apache

### Setup Database
The `dbconnect.php` uses the following environment variables to resolve your mysql credentials.

```bash
export MYSQL_SVC=localhost
export MYSQL_USER=replace_me
export MYSQL_PASSWORD=replace_me
export MYSQL_DATABASE=spider
```

Once the above envs are set, we can create the tables required:

```
curl https://raw.githubusercontent.com/redhat-cop/rti/master/database.sql | mysql --host=${MYSQL_SVC} --database=${MYSQL_DATABASE} --user=${MYSQL_USER} --password=${MYSQL_PASSWORD}
```

## Setup captcha
This app uses a captcha in `register.php` to ensure no robot creation of users.
To register with recaptcha v2, visit: https://www.google.com/recaptcha/intro

```bash
export CAPTCHA_SITEKEY=replace_me
````

Securimage: A PHP class dealing with CAPTCHA images, audio, and validation
https://www.phpcaptcha.org/documentation/quickstart-guide/

## Deploying on OpenShift
NOTE: The `.openshift/3-app.yml` `Secret/captcha` needs updating before deploying.

```bash
oc new-project rti

oc create -f .openshift/1-mysql.yaml
oc rollout status dc/mysql --watch=true

oc create -f .openshift/2-db-init.yaml

oc create -f .openshift/3-app.yml
oc rollout status deployment/rti --watch=true

open "https://$(oc get route rti -o jsonpath={.spec.host})"
```