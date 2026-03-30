# Spyrosoft UCP - Universal Checkout Protocol for Magento 2

**Unlock the Future of AI-Powered Commerce with Standardized Checkout Integration**

## Overview

**Spyrosoft UCP** is a Proof of Concept (PoC) Magento 2 module prepared to work with the [Universal Checkout Protocol (UCP)](https://ucp.dev/specification/overview/) mechanism.

UCP itself is currently under active development. The first publicly available version is expected to support only the US market, and the specification and supported capabilities may still change.

This PoC provides an implementation of the core UCP functionalities known at this point in time, exposing a standardized checkout interface for UCP-compliant clients (e-commerce platforms, AI agents, and payment providers), with a focus on extensibility and protocol-driven interoperability.

### Why UCP Matters for Your Business

| Challenge | UCP Solution |
|-----------|--------------|
| Complex integration per payment provider | Single standardized API for all providers |
| Limited AI/chatbot commerce capabilities | Native support for autonomous AI agents |
| Fragmented checkout experiences | Unified protocol across all touchpoints |
| Slow time-to-market for new channels | Instant compatibility with UCP ecosystem |

## Key Benefits

- **AI-Ready Commerce** - Enable AI agents and chatbots to complete purchases on behalf of customers through standardized protocols
- **Reduced Integration Costs** - One implementation supports the entire UCP ecosystem of platforms and payment providers
- **Future-Proof Architecture** - Built on an open specification with versioned schemas and capability negotiation
- **PCI-DSS Compliant by Design** - Tokenized payment credentials keep sensitive data off your servers
- **Enterprise Extensibility** - Leverage Magento 2's powerful dependency injection for unlimited customization

---

## Installation

1. Require the module:

```bash
composer require spyrosoft/magento2-google-ucp
```

2. Enable the module:

```bash
bin/magento module:enable Spyrosoft_Ucp
bin/magento setup:upgrade
bin/magento cache:flush
```

---

## Configuration

Configuration options are available in **Stores > Configuration > Sales > Universal Commerce Protocol**:

### General
- **Is Enabled** - Enable/disable the UCP functionalities

### Catalog
- **Product Identifier** - Select which product attribute should be used as product identifier in UCP (default: SKU)

---

## Implemented Functionalities

### Core Checkout Session Management

| Feature | Description |
|---------|-------------|
| **Create Session** | Initialize checkout with line items, currency, buyer info, and fulfillment preferences |
| **Update Session** | Modify cart contents, shipping addresses, and selected fulfillment options |
| **Retrieve Session** | Get complete checkout state including totals, available methods, and validation messages |
| **Complete Session** | Process payment and convert checkout to confirmed order |
| **Cancel Session** | Gracefully terminate checkout and release resources |

### RESTful API Endpoints

```
POST   /rest/V1/ucp/checkout-sessions              # Create new session
PUT    /rest/V1/ucp/checkout-sessions/:id          # Update session
GET    /rest/V1/ucp/checkout-sessions/:id          # Retrieve session
POST   /rest/V1/ucp/checkout-sessions/:id/complete # Complete checkout
POST   /rest/V1/ucp/checkout-sessions/:id/cancel   # Cancel session
GET    /.well-known/ucp                            # Capability discovery
```

### UCP Protocol Compliance

- **Capability Discovery** - Automatic `/.well-known/ucp` endpoint publishing supported services and capabilities
- **Version Negotiation** - `UCP-Agent` header validation ensuring client-server compatibility
- **Reverse-Domain Namespacing** - Full support for UCP's decentralized governance model

### Supported UCP Capabilities

| Capability | Specification                                                      |
|------------|--------------------------------------------------------------------|
| `dev.ucp.shopping.checkout` | Core checkout session management                                   |
| `dev.ucp.shopping.fulfillment` | Shipping methods and delivery options                              |
| `dev.ucp.shopping.order` | Order representation in UCP |

### Payment Processing

- **Google Pay** - Production-ready Google Pay integration with full tokenization support
- **Multiple Payment Handlers** - Module may be extended with additional payment methods through handler registry pattern

In current implementation, Google Pay is powered by [Przelewy24](https://commercemarketplace.adobe.com/przelewy24-magento2-przelewy24.html) module.
Additional [Payment Service Providers](https://developers.google.com/pay/api) may be integrated by extending payment handler registry.

### Checkout Data Model

Complete implementation of required UCP checkout schema including:

- **Line Items** - Products with SKU, title, quantity, unit price, and line totals
- **Buyer Information** - Name, email, phone, and billing address
- **Fulfillment** - Shipping methods, rates, destinations, and delivery groups
- **Totals** - Subtotal, tax, discounts, fulfillment costs, and grand total
- **Messages** - Validation errors, warnings, and informational notices
- **Order Confirmation** - Order ID, status, and permalink after completion

### Guest Checkout Support

All API endpoints support anonymous access, enabling frictionless guest checkout experiences without requiring customer registration.

---

## Extensibility Features

Spyrosoft UCP leverages Magento 2's powerful dependency injection system to provide enterprise-grade extensibility at every layer.

### Payment Handler Extension

Add custom payment methods by implementing `HandlerProviderInterface` and registering via DI:

```xml
<!-- etc/di.xml -->
<type name="Spyrosoft\Ucp\Service\Payment\HandlerList">
    <arguments>
        <argument name="providers" xsi:type="array">
            <item name="your_payment_method" xsi:type="object">
                Vendor\Module\Service\Payment\Handler\YourHandler
            </item>
        </argument>
    </arguments>
</type>
```

**Extension Points:**
- `HandlerProviderInterface::getHandler()` - Define payment method metadata and configuration
- `HandlerProviderInterface::handle()` - Process payment with custom gateway logic

### Checkout Builder Extension

Extend checkout response building using the Composite Builder pattern:

```xml
<!-- etc/di.xml -->
<type name="Spyrosoft\Ucp\Service\Builder\Checkout\CompositeBuilder">
    <arguments>
        <argument name="builders" xsi:type="array">
            <item name="custom_data" xsi:type="object">
                Vendor\Module\Service\Builder\Checkout\CustomData
            </item>
        </argument>
    </arguments>
</type>
```

**Available Builder Extension Points:**
- `BuilderInterface::build()` - Add custom data to checkout response
- Buyer, LineItems, Totals, Payment, Fulfillment, OrderConfirmation builders

### Validation Extension

Add custom validation rules through the Composite Validator pattern:

```xml
<!-- Checkout Validation -->
<type name="Spyrosoft\Ucp\Service\Validator\Checkout\CompositeValidator">
    <arguments>
        <argument name="validators" xsi:type="array">
            <item name="custom_rule" xsi:type="object">
                Vendor\Module\Service\Validator\Checkout\CustomRule
            </item>
        </argument>
    </arguments>
</type>

<!-- Request Validation -->
<type name="Spyrosoft\Ucp\Service\Validator\Request\CompositeValidator">
    <arguments>
        <argument name="validators" xsi:type="array">
            <item name="custom_request_rule" xsi:type="object">
                Vendor\Module\Service\Validator\Request\CustomRequestRule
            </item>
        </argument>
    </arguments>
</type>
```

**Built-in Validators:**
- Currency validation against store configuration
- UCP-Agent version negotiation
- Fulfillment address completeness

### UCP Capabilities Extension

Register custom capabilities for your UCP implementation:

```xml
<type name="Spyrosoft\Ucp\Service\Builder\Ucp">
    <arguments>
        <argument name="capabilities" xsi:type="array">
            <item name="com.yourcompany.custom-capability" xsi:type="array">
                <item name="spec" xsi:type="string">https://yourcompany.com/ucp/spec</item>
                <item name="schema" xsi:type="string">https://yourcompany.com/ucp/schema.json</item>
            </item>
        </argument>
    </arguments>
</type>
```

---

## Architecture Highlights

### Design Patterns

| Pattern | Implementation | Benefit |
|---------|----------------|---------|
| **Composite** | Builders, Validators | Unlimited extensibility without core modification |
| **Strategy** | Payment Handlers | Swap payment implementations at runtime |
| **Registry** | HandlerList | Dynamic payment method registration |
| **Facade** | CheckoutManagement | Simplified API surface for complex operations |
| **Builder** | Checkout Builder | Clean construction of complex response objects |

---

## Roadmap

### General Enhancements
- **Authentication** - Implement [Identity Linking Capacity](https://ucp.dev/specification/identity-linking)
- **Schema Validation** - Extend request/response [validation](https://ucp.dev/specification/overview/#negotiation-protocol) against official UCP JSON schemas

### Checkout Capabilities
- **Links** - Implement [UCP Links](https://ucp.dev/specification/checkout/#link) specification for enhanced checkout flows
- **Buyer Consent Extension** - Add support for [Buyer Consent](https://ucp.dev/specification/buyer-consent) Capability
- **Discount Extension** - Implement discount codes and promotions using [UCP Discounts](https://ucp.dev/specification/discount) specification
- **Validation Enhancements** - Expand validation rules with inventory and buyer verification
- **Continue URL** - Add support for `continue_url` to implement checkout session recovery flow
- **Product Images** - Include product `image_url` in line item representation

### Cart Capability
- **Cart** - Implement [Cart Capability](https://ucp.dev/draft/specification/cart/) for pre-checkout cart management and persistence

### Catalog Capability
- **Catalog** - Implement [Catalog Capability](https://ucp.dev/draft/specification/catalog/)

### Checkout Fulfillment
- **Pickup Point Fulfillment** - Integrate with [in-store](https://ucp.dev/specification/fulfillment/#retail-location-response) pickup shipping methods

### Payment Enhancements
- **Card Credential** - Add support for [Card Credential](https://ucp.dev/specification/checkout/#card-credential) payment instruments
- **Additional Payment Methods** - Integrate with additional payment methods once UCP support will be extended

### Order Processing
- **Order Capability** - Implement full [Order Capability](https://ucp.dev/specification/order/) including order retrieval and management
- **Order Permalink** - Add support for order permalink in order confirmation response
- **Webhooks** - Add support for [Order Event Webhooks](https://ucp.dev/specification/order/#order-event-webhook)

---

## License

This project is licensed under the **Apache License, Version 2.0** (Apache-2.0).

See: https://www.apache.org/licenses/LICENSE-2.0
