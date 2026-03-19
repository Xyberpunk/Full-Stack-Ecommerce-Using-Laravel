# Security Policy

## Supported Scope

Security reports are relevant for:

- authentication and authorization issues
- payment and checkout vulnerabilities
- exposed secrets or insecure configuration
- privilege escalation in admin or account flows
- unsafe file upload handling
- database access or data exposure issues

## Reporting a Vulnerability

Please do not publish sensitive vulnerabilities in public issues.

Instead, report privately to the project maintainer with:

- a clear description of the issue
- affected area or file paths
- steps to reproduce
- potential impact
- proof of concept if available

## Response Expectations

After a valid report:

- the issue should be acknowledged
- the impact should be reviewed
- a fix or mitigation should be prepared
- exposed secrets should be rotated if necessary

## Operational Security Notes

Before deployment:

- rotate any test or secret keys that were exposed during development
- never commit `.env`
- keep `.env.example` free of real credentials
- configure production `APP_DEBUG=false`
- configure Stripe webhook secrets only in deployment environment variables

## Common Sensitive Values

Do not commit or share:

- `APP_KEY`
- database passwords
- mail credentials
- Stripe secret keys
- Stripe webhook signing secrets
- cloud provider credentials
