# Octommerce Api Guidelines

## 1 Abstract
The Octommerce API Guidelines, as a design principle, encourages application developers to have resources accessible to them via a RESTful HTTP interface.
To provide the smoothest possible experience for developers on platforms following the Octommerce API Guidelines, REST APIs SHOULD follow consistent design guidelines to make using them easy and intuitive.
And This API is very powerfull for e-commerce multiplatform

## 2 Table of contents
- [Octommerce API Guidelines](#Octommerce-api-guidelines)
	- [1 Abstract](#1-abstract)
	- [2 Table of contents](#2-table-of-contents)
	- [3 Introduction](#3-introduction)
	- [4    URL STRUCTURE](http://htmlpreview.github.io/?https://github.com/octommerce/api/blob/master/octommerce-api.html)
    
## 3 Introduction
Developers access most Platform resources via HTTP interfaces.
Although each service typically provides language-specific frameworks to wrap their APIs, all of their operations eventually boil down to HTTP requests.
Thus a goal of these guidelines is to ensure Octommerce APIs can be easily and consistently consumed by any client with basic HTTP support.

## 4 Consistency fundamentals
### 4.1 URL structure
Humans SHOULD be able to easily read and construct URLs.

This facilitates discovery and eases adoption on platforms without a well-supported client library.

An example of a well-structured URL is:

```
https://api.octommerce.com/v1/people/jdoe@contoso.com/inbox
```

An example URL that is not friendly is:

```
https://api.octommerce.com/EWS/OData/Users('jdoe@microsoft.com')/Folders('AAMkADdiYzI1MjUzLTk4MjQtNDQ1Yy05YjJkLWNlMzMzYmIzNTY0MwAuAAAAAACzMsPHYH6HQoSwfdpDx-2bAQCXhUk6PC1dS7AERFluCgBfAAABo58UAAA=')
```

A frequent pattern that comes up is the use of URLs as values.
Services MAY use URLs as values.
For example, the following is acceptable:

```
https://api.octommerce.com/v1/items?url=https://resources.contoso.com/shoes/fancy
```




