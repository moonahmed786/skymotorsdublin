
# Sky Motors — Product Requirements & Corrections (Combined)

## Document Sources
- **APP SKY MOTORS.docx** — Corrections and Additions (22-06-2025)
- **Sky Motors PRD (1).pdf** — Product Requirements Document v1.0 (Dec 19, 2024)

---

## 1. Corrections & Additions (APP SKY MOTORS)

### 1.1 Add a Car — Brands & Models

**Mazda**
- Add brand

**Honda**
- Honda Vezel X (convert Vezel into)
- Honda Vezel Z (add)

**Toyota**
- Toyota Vitz Petrol (add)
- Toyota Vitz Hybrid (add)
- Toyota CHR (add)

**Volkswagen**
- VW Polo (convert HS)

**Audi**
- Audi A1 3D (add)
- Audi A1 5D (add)

---

### 1.2 Basic Information (Form Updates)
- Color: add **Pearl**
- Chassis Number: **uppercase only**
- Registration Number: **uppercase only**
- Mileage: move under **Basic Information**
- Engine Size: add field (e.g., 1.0, 1.8, 2.5)

---

### 1.3 Pricing Information
- Add:
  - VRT (date)
  - Customs
  - VAT on Customs

---

### 1.4 Dates & Status Updates
- Manufacture Year: **year only**
- Collection Date: move to **Vehicle Status** (after Sold)
- Date Format: **DD/MM/YYYY**

**Vehicle / NCT Status**
- NCT: Done / Pending / Failed / Visual (Not Required)

**Radio**
- Replaced / Working / Not Working

**Paint Condition**
- Good / Need Paint 1 / Need Paint 2 / Need Paint 3

**Valet**
- Done / Pending / Ready to Collect

**Tyre Condition**
- Good E4 / Not E4 / New E4 / Bad E4

**Back Camera**
- Working / Not Working

**Parking**
- New Garage / Old Garage / Duffy

**Sales Status**
- Available
- Sold (show date selector)
- Date of Collection (after Sold)

---

### 1.5 Questions & Reporting Needs
- Where are car images shown after adding?
- Hide **Sold** cars from main dashboard
- Fix prices on main dashboard
- Export to Excel with date filters (e.g., monthly):
  - Registration Number
  - Chassis Number
  - Model
  - VRT
  - Customs
  - VAT on Customs
  - Sold Price

**Required Filters**
- Car Model
- Manufacture Year
- Parking
- NCT
- Sold / Available
- Pricing
- Service Done

---

## 2. Product Requirements (Sky Motors PRD)

### 2.1 Introduction
Car Management Buy-and-Purchase Application for managing inventory lifecycle: buying, cleaning, servicing, and selling.

### 2.2 Goals & Objectives
- Streamline purchase/sales
- Maintain detailed vehicle records
- Easy retrieval & updates
- Intuitive dashboard

---

## 3. Features

### 3.1 Car Management
- Add/Delete/Edit Cars
- Upload Pictures
- To-do board (today/tomorrow)

**Car Attributes**
- Car Type, Colour, Chassis No, Registration No
- Purchase Price, Selling Price, Sold Status
- Year of Manufacture
- NCT Status
- Mileage
- Service + Notes (300 chars)
- Radio, Paint, Valet, Tyres, Back Camera
- Collection Date

---

### 3.2 Search & Filtering
- Search by Registration or Chassis Number
- Filters:
  - Car Type
  - Year
  - Collection Date
  - Sold vs Available
  - Monthly/Yearly totals

---

### 3.3 Data Collection & Reporting
- DVRT (Daily Vehicle Reporting Tool)
- Sales reports and trends

---

### 3.4 Management Dashboard
- Available vs Sold summary
- Service summaries
- Collection dates & statuses

---

## 4. Detailed Specifications

### 4.1 Supported Models
- Honda Fit (F/L/S)
- VW Polo 1.2 / HS
- VW Golf 1.2 / 1.4 / Variant
- Audi A1 (3D/5D), A3 Hatchback/Sedan
- Honda Vezel
- Nissan Note (Auto/Hybrid)
- Prius (5/7 Seater)

### 4.2 Attributes & Formats
- Chassis No: Alphanumeric
- Year: 2013–2025
- NCT: Done / Retest / Visual
- Colour: Red, White, Pearl, Black, Blue
- Mileage: Numeric
- Price: Numeric (€)

---

## 5. Modules & Estimated Hours

1. User Management — 30h
2. Car Inventory — 70h
3. Search & Filtering — 20h
4. Reporting — 12h
5. Dashboard — 8h
6. Attributes Config — 15h
7. UI — 20h
8. Non-Functional — 15h

---

## 6. Non-Functional Requirements
- Performance: ≥1000 cars
- Scalability
- Security & Authentication

---

## 7. Conclusion
This combined document consolidates corrections, enhancements, and the full PRD for clear implementation and development planning.
