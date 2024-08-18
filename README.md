### Used Design Pattern
1. **策略模式**
    - 因需求是根據不同欄位有不同的驗證以及轉換的規則，並且考量到未來可能會新增其他欄位的驗證規則，所以採用策略模式。實作的方式是定義 `OrderFieldHandlerInterface (Strategy)` 並且根據不同欄位實作對應 `FieldHandler (ConcreteStrategy)` 來處理欄位的驗證與轉換邏輯，由 `OrderService (Context)` 引用並觸發驗證與轉換。
  
2. **工廠模式**
    - 因 `OrderService` 在引用 `FieldHandler` 時會涉及到 `FieldHander` 的建立，導致兩個類別耦合，未來若有新增新的 `FieldHander` 時勢必會改動到 `OrderService`，因此加入了工廠 `OrderHandlerFactoryInterface` 、 `OrderHandlerFactory` 來處理 `FieldHandler` 的建立，`OrderService` 則改為引用工廠類別，進而達成兩個類的解耦。

### SOLID Explain
1. **單一職責原則 (Single Responsibility Principle, SRP)**：
   - 透過切分 `Factory` `Handler` `Service` 等類別，將建立、呼叫、驗證等職責分派給對應的類別，進而達到每個類別只有一個職責。
   - 可改善：`Handler` 裡其實有兩個方法，可以分開成為不同的介面。

2. **開放封閉原則 (Open/Closed Principle, OCP)**：
   - 透過策略模式以及工廠模式，未來在擴展新的欄位驗證規則時，可以透過增加新的 `FieldHandler` 來實現，而不需要修改到核心的程式碼。進而達到在改動時「對擴展開放，對修改封閉」的原則。

3. **里氏替換原則 (Liskov Substitution Principle, LSP)**：
   - 子類別應該能夠替換它們的父類別而不改變程序的正確性。這確保了子類別和父類別之間的行為一致性，使得代碼在使用子類別時不需要知道它是具體哪一個類別。
   - 專案設計的部分並沒有使用到類別間的繼承。

4. **介面隔離原則 (Interface Segregation Principle, ISP)**：
   - 不應該強迫客戶端依賴於它們不使用的方法。這意味著應該將大型介面分解為小型、專門化的介面，以便客戶端僅需實現其實際需要的功能。
   - 如上所說，`Handler` 裡其實有兩個方法，可以分開成為不同的介面，會更符合 ISP。

5. **依賴反轉原則 (Dependency Inversion Principle, DIP)**：
   - 讓 `UserService` 引用 `OrderHandlerFactoryInterface` 這個介面，而不是直接引用 `OrderHandlerFactory` 這個實體類別，進而實現 DIP。`OrderHandlerFactory` 需要實現 `OrderHandlerFactoryInterface`，在 `Interface` 沒有變動的情況下，可以確保 `Factory` 的改動不會影響到 `Service`。

### Run the App
##### Clone project
- `git clone https://github.com/cheng-yu/demo-orders-api.git`
- `cd demo-orders-api`
##### Build and run with Docker
- `docker build -t demo-orders-api .`
- `docker run -p 8000:8000 --rm -d --name demo demo-orders-api`
##### Show logs
- `docker logs -f demo`
##### Run tests
- `docker exec -it demo vendor/bin/pest`
##### Stop App
- `docker stop demo`