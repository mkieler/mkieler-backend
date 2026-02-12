# API v1 Documentation

Base URL: `/api/v1`

## Endpoints

### GET /pages/{slug}

Returns a single page with all related data.

**Response:**

```json
{
  "slug": "home",
  "name": "Forside",
  "author": {
    "name": "Mattias Kieler",
    "jobTitle": "Fractional CTO og senior fullstack-udvikler",
    "image": "~/assets/img/mig.png"
  },
  "seo": {
    "title": "Page Title",
    "description": "Page description",
    "ogTitle": "OG Title",
    "ogDescription": "OG Description",
    "ogImage": "/og-image.jpg"
  },
  "schemaOrg": {
    "global": {
      "person": {
        "@type": "Person",
        "name": "Mattias Kieler",
        "jobTitle": "Fractional CTO og senior fullstack-udvikler",
        "email": "hello@mkieler.dev",
        "url": "https://mkieler.com",
        "sameAs": ["https://linkedin.com/...", "https://github.com/..."]
      },
      "localBusiness": {
        "@type": "LocalBusiness",
        "name": "Mattias Kieler",
        "description": "Freelance fullstack-webudvikling med Laravel og Nuxt",
        "url": "https://mkieler.com",
        "areaServed": "Denmark",
        "priceRange": "$$"
      },
      "professionalService": {
        "@type": "ProfessionalService",
        "name": "Mattias Kieler",
        "description": "...",
        "serviceType": "Web Development",
        "provider": { "@type": "Person", "..." }
      },
      "webSite": {
        "@type": "WebSite",
        "name": "Mattias Kieler",
        "url": "https://mkieler.com",
        "publisher": { "@type": "Person", "..." }
      },
      "siteNavigationElement": {
        "@type": "SiteNavigationElement",
        "name": "Main Navigation",
        "hasPart": [
          { "@type": "SiteNavigationElement", "name": "Forside", "url": "..." },
          { "@type": "SiteNavigationElement", "name": "Services", "url": "..." }
        ]
      }
    },
    "page": {
      "@type": "WebPage",
      "name": "Page Title",
      "description": "Page description",
      "url": "https://mkieler.com/home"
    },
    "breadcrumb": {
      "@type": "BreadcrumbList",
      "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "Forside", "item": "https://mkieler.com" },
        { "@type": "ListItem", "position": 2, "name": "Page Name", "item": "https://mkieler.com/slug" }
      ]
    }
  },
  "components": {
    "FrontpageHero": {
      "name": "FrontpageHero",
      "eyebrow": "...",
      "headline": "...",
      "supportingText": "...",
      "bulletpoint": [
        { "title": "...", "description": "...", "icon": "..." }
      ]
    }
  }
}
```

---

### GET /services

Returns all services.

**Response:**

```json
[
  {
    "slug": "webudvikling",
    "title": "Websites",
    "headline": "Websites udviklet med SSG-teknologier...",
    "description": "Kort beskrivelse",
    "longDescription": "Lang beskrivelse",
    "features": ["Feature 1", "Feature 2"],
    "technologies": ["Laravel", "Nuxt"],
    "benefits": ["Benefit 1", "Benefit 2"],
    "icon": "i-lucide-code",
    "relatedServices": ["frontend", "backend"],
    "useCases": ["Use case 1", "Use case 2"],
    "seo": {
      "title": "SEO Title",
      "description": "SEO Description",
      "ogTitle": "OG Title",
      "ogDescription": "OG Description"
    },
    "schemaOrg": {
      "service": {
        "@type": "Service",
        "name": "Websites",
        "description": "...",
        "url": "https://mkieler.com/services/webudvikling",
        "provider": { "@type": "Person", "name": "Mattias Kieler" },
        "areaServed": { "@type": "Country", "name": "Denmark" },
        "serviceType": "WebDevelopment"
      },
      "breadcrumb": {
        "@type": "BreadcrumbList",
        "itemListElement": [
          { "@type": "ListItem", "position": 1, "name": "Forside", "item": "..." },
          { "@type": "ListItem", "position": 2, "name": "Services", "item": "..." },
          { "@type": "ListItem", "position": 3, "name": "Websites", "item": "..." }
        ]
      },
      "faqPage": {
        "@type": "FAQPage",
        "mainEntity": [
          {
            "@type": "Question",
            "name": "Question?",
            "acceptedAnswer": { "@type": "Answer", "text": "Answer" }
          }
        ]
      }
    },
    "processes": [
      { "step": 1, "title": "Step 1", "description": "Description" }
    ],
    "faqs": [
      { "question": "Question?", "answer": "Answer" }
    ]
  }
]
```

---

### GET /services/{slug}

Returns a single service.

**Response:** Same structure as single item in `/services` array.

---

### GET /testimonials

Returns all testimonials.

**Response:**

```json
[
  {
    "quote": "Testimonial quote text",
    "author": {
      "name": "John Doe",
      "jobTitle": "CEO",
      "company": "Company Name",
      "image": "/path/to/image.jpg"
    },
    "schemaOrg": [
      {
        "type": "Review",
        "data": {
          "@type": "Review",
          "reviewBody": "Testimonial quote text",
          "author": {
            "@type": "Person",
            "name": "John Doe",
            "jobTitle": "CEO"
          },
          "itemReviewed": {
            "@type": "LocalBusiness",
            "name": "Mattias Kieler"
          }
        }
      }
    ]
  }
]
```

---

## Schema.org Types

### Global (returned on every page)

| Type | Description |
|------|-------------|
| `Person` | Site owner info with social links (sameAs) |
| `LocalBusiness` | Business info for local SEO |
| `ProfessionalService` | Specific service type for freelancers |
| `WebSite` | Website metadata with publisher |
| `SiteNavigationElement` | Main navigation structure |

### Page-specific

| Type | Description |
|------|-------------|
| `WebPage` | Auto-generated from SEO data |
| `BreadcrumbList` | Navigation path to current page |
| `FAQPage` | Generated for services with FAQs |
| `Service` | Generated for each service |
| `Review` | Generated for testimonials |

### Helper Methods (SchemaConfig)

```php
// Generate breadcrumb for any path
SchemaConfig::breadcrumbList([
    ['name' => 'Forside', 'url' => 'https://...'],
    ['name' => 'Services', 'url' => 'https://...'],
]);

// Get contact page schema
SchemaConfig::contactPage();
```

---

## Notes

- All schema data is ready for JSON-LD injection in the frontend
- Breadcrumbs are auto-generated based on page/service hierarchy
- FAQPage schema is only included when FAQs exist
- Social links (sameAs) connect to LinkedIn and GitHub profiles
